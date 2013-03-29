<?php

/**
 * This is the model class for table "tianyi_contacts".
 *
 * The followings are the available columns in table 'tianyi_contacts':
 * @property integer $contacts_id
 * @property string $contacts_name
 * @property string $contacts_cell
 * @property string $contacts_hometel
 * @property string $contacts_officetel
 * @property string $contacts_title
 * @property integer $enterprise_id
 */
class Contacts extends CActiveRecord
{
    // get all contacts belongs to same enterprise
    public function getEnterpriseContactsList($enterpriseId)
    {
        $contactsList = Contacts::model ()->findAll ( "enterprise_id = $enterpriseId" );
        $ret_val = CHtml::listData ( $contactsList, 'contacts_id', 'contacts_name' );
        return $ret_val;
    }

    /**
     * Returns the static model of the specified AR class.
     * 
     * @param string $className
     *            active record class name.
     * @return Contacts the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model ( $className );
    }

    /**
     *
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tianyi_contacts';
    }

    /**
     *
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array (
                array (
                        'contacts_name',
                        'required' 
                ),
                array (
                        'enterprise_id',
                        'numerical',
                        'integerOnly' => true 
                ),
                array (
                        'contacts_name',
                        'length',
                        'max' => 20 
                ),
                array (
                        'contacts_cell, contacts_hometel, contacts_officetel, contacts_title',
                        'length',
                        'max' => 12 
                ),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array (
                        'contacts_id, contacts_name, contacts_cell, contacts_hometel, contacts_title, contacts_officetel, enterprise_id',
                        'safe',
                        'on' => 'search' 
                ) 
        );
    }

    /**
     *
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array ();
    }
    
    // set user->contacts_id to zero before delete contacts.
    public function beforeDelete()
    {
        User::model ()->updateAll ( array (
                "contacts_id" => 0 
        ), "contacts_id = $this->contacts_id" );
        return true;
    }
    
    // set enterprise_id for record
    public function beforeSave()
    {
        if (! parent::beforeSave ())
        {
            return false;
        }
        
        if ($this->isNewRecord)
        {
            $this->enterprise_id = Yii::app ()->user->enterprise_id;
        }
        
        return true;
    }

    /**
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array (
                'contacts_id' => 'Contacts',
                'contacts_name' => 'Contacts Name',
                'contacts_cell' => 'Contacts Cell',
                'contacts_hometel' => 'Contacts Hometel',
                'contacts_officetel' => 'Contacts Officetel',
                'enterprise_id' => 'Enterprise' 
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * 
     * @return CActiveDataProvider the data provider that can return the models
     *         based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria ();
        $criteria->compare ( 'contacts_id', $this->contacts_id );
        $criteria->compare ( 'contacts_name', $this->contacts_name, true );
        $criteria->compare ( 'contacts_cell', $this->contacts_cell, true );
        $criteria->compare ( 'contacts_hometel', $this->contacts_hometel, true );
        $criteria->compare ( 'contacts_officetel', $this->contacts_officetel, true );
        $criteria->compare ( 'enterprise_id', $this->enterprise_id );
        
        return new CActiveDataProvider ( $this, array (
                'criteria' => $criteria 
        ) );
    }

    public static function parseExcelFileToArray($file)
    {
        require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
        require Yii::app ()->getBasePath () . '/lib/phpexcel/PHPExcel/IOFactory.php';
        
        $filePath = getExcelFileDirAbsolute () . $file;
        $objPHPExcel = PHPExcel_IOFactory::load ( $filePath );
        $sheetData = $objPHPExcel->getActiveSheet ()->toArray ( null, true, true, true );
        
        // remove header line.
        array_shift ( $sheetData );
        
        // return $sheetData;
        // following arrays should be returned.
        $userArray = Array ();
        $cellArray = Array ();
        $badLineArray = Array ();
        $contactsArray = Array ();
        $newDepartmentArray = Array ();
        $duplicateLineArray = Array ();
        $userDepartmentArray = Array ();
        $userContactsArray = Array ();
        
        // temp values
        $enterpriseId = Yii::app ()->user->enterprise_id;
        $permissionId = '3'; // all users are cell phone user.
        $enterpriseLoginType = 0; // login type 0 => IMSI, 1 =>
                                  // username/password
        
        $existedDepartmentArray = Department::model ()->findAll ( "enterprise_id = $enterpriseId ");
        // temp arrays
        $departmentHash = Array ();
        $departmentNameArray = Array ();
        foreach ( $existedDepartmentArray as $dep )
        {
            array_push ( $departmentNameArray, $dep );
            $departmentHash [$dep->department_name] = $dep;
        }
        
        $existedUserArray = User::model ()->findAll ( "permission_id = '3' and enterprise_id = $enterpriseId");
        $usernameArray = Array ();
        foreach ( $existedUserArray as $user )
        {
            array_push ( $usernameArray, $user->username );
        }
        
        // line number
        $lineIndex = 2;
        $userAddType = 0; // user type 0 => only add user, 1 => only add
                          // contacts, 2=> add user and contacts
        
        define ( 'UATYPE_USER_ONLY', '0' );
        define ( 'UATYPE_CONTACTS_ONLY', '1' );
        define ( 'UATYPE_USER_CONTACTS', '2' );
        // parse excel file line by line
        //
        // example
        // A B C D E F G H I
        // 联系人姓名 手机号码 办公室电话 家庭电话 排序编号 特别数据 部门名 1 职称
        // Leo 18049229109 87401234 67401234 0 1111111 软件部,硬件部 2 县长
        
        foreach ( $sheetData as $line )
        {
            // --data initialization
            // contacts
            $contacts = new Contacts ();
            $contacts->contacts_name = $line ['A'] ? $line ['A'] : $line ['B'];
            $contacts->contacts_cell = $line ['B'];
            $contacts->contacts_title = $line ['I'];
            $contacts->contacts_officetel = $line ['C'];
            $contacts->contacts_hometel = $line ['D'];
            $contacts->enterprise_id = $enterpriseId;
            
            // users
            $user = new User ();
            $user->username = $line ['B'];
            $user->password = $line ['B'];
            $user->permission_id = $permissionId;
            $user->enterprise_id = $enterpriseId;
            $user->user_extra = $line ['F'];
            $user->user_position = $line ['E'];
            
            // cellphone duplicate
            $cellNo = strval ( $line ['B'] );
            if (isset ( $cellArray [$cellNo] ) || in_array ( $cellNo, $usernameArray ))
            {
                if (in_array ( $cellNo, $usernameArray ))
                {
                    $duplicateLineArray [strval ( $lineIndex )] = "Duplicate with database";
                }
                else
                {
                    $duplicateLineArray [strval ( $lineIndex )] = "Duplicate with line:" . $cellArray [strval ( $line ['B'] )];
                }
                ++ $lineIndex;
                continue;
            }
            else
            {
                if (trim ( $line ['B'] ) != null)
                {
                    $cellArray [strval ( $line ['B'] )] = $lineIndex;
                }
            }
            
            $lineDepartment = explode ( ',', $line ['G'] );
            
            if (trim ( strval ( $line ['H'] ) ) != "")
            {
                $userAddType = strval ( $line ['H'] );
            }
            // --data initialization
            
            // ---data verification and trim
            
            // add user only
            if ($userAddType == UATYPE_USER_ONLY)
            {
                if (trim ( $line ['B'] ) == null)
                {
                    $badLineArray ["$lineIndex"] = 'username is null. username:' . $line ['B'];
                    ++ $lineIndex;
                    continue;
                }
                
                $userArray [$lineIndex] = $user;
                
                $lineDepartmentArray = explode ( ',', $line ['G'] );
                $departmentArray = Array ();
                $department = null;
                foreach ( $lineDepartmentArray as $dep )
                {
                    if (in_array ( $dep, $departmentNameArray ))
                    {
                        array_push ( $departmentArray, $departmentHash [$dep] );
                    }
                    else
                    {
                        $department = new Department ();
                        $department->department_name = $dep;
                        array_push ( $newDepartmentArray, $department );
                        array_push ( $departmentArray, $department );
                    }
                }
                
                $userDepartmentArray ["$lineIndex"] = array (
                        'department' => $departmentArray,
                        'user' => $user 
                );
                
                ++ $lineIndex;
                continue;
            }
            // add contacts only
            elseif ($userAddType == UATYPE_CONTACTS_ONLY)
            {
                if (trim ( $line ['B'] ) == null && trim ( $line ['C'] ) == null && trim ( $line ['D'] ) == null)
                {
                    $badLineArray ["$lineIndex"] = 'cell, officetel and hometel are all null. username:' . $line ['B'];
                    ++ $lineIndex;
                    continue;
                }
                
                $contactsArray [$lineIndex] = $contacts;
                ++ $lineIndex;
                continue;
            }
            // add user and contacts
            elseif ($userAddType == UATYPE_USER_CONTACTS)
            {
                if ((trim ( $user ['username'] ) == null) || (trim ( $line ['B'] ) == null && trim ( $line ['C'] ) == null && trim ( $line ['D'] ) == null))
                {
                    $badLineArray [$lineIndex] = 'username or all cell, officetel or hometel are null.  username:' . $line ['B'];
                    ++ $lineIndex;
                    continue;
                }
                
                // user table and contacts table
                $contactsArray ["$lineIndex"] = $contacts;
                $userArray ["$lineIndex"] = $user;
                
                $userContactsArray ["$lineIndex"] = Array (
                        'user' => $user,
                        'contacts' => $contacts 
                );
                
                $lineDepartmentArray = explode ( ',', $line ['G'] );
                $departmentArray = Array ();
                $department = null;
                foreach ( $lineDepartmentArray as $dep )
                {
                    if (in_array ( $dep, $departmentNameArray ))
                    {
                        array_push ( $departmentArray, $departmentHash [$dep] );
                    }
                    else
                    {
                        $department = new Department ();
                        $department->department_name = $dep;
                        array_push ( $newDepartmentArray, $department );
                        array_push ( $departmentArray, $department );
                    }
                }
                
                $userDepartmentArray ["$lineIndex"] = array (
                        'department' => $departmentArray,
                        'user' => $user 
                );
                
                ++ $lineIndex;
                continue;
            }
            // others
            else
            {
            }
        }
        
        $retVal = array (
                'user' => $userArray,
                'badLine' => $badLineArray,
                'contacts' => $contactsArray,
                'department' => $newDepartmentArray,
                'userContacts' => $userContactsArray,
                'userDepartment' => $userDepartmentArray,
                'duplicateLine' => $duplicateLineArray,
                'filename' => $file 
        );
        
        return $retVal;
    }

    public static function importAll($excelResult)
    {
        foreach ( $excelResult ['contacts'] as $contacts )
        {
            $contacts->save ();
        }
        
        $newUserArray = Array ();
        
        foreach ( $excelResult ['userContacts'] as $lineNo => $userContacts )
        {
            $userContacts ['contacts']->save ();
            $userContacts ['user']->contacts_id = $userContacts ['contacts']->contacts_id;
            $userContacts ['user']->save ();
            array_push ( $newUserArray, $userContacts ['user']->username );
        }
        
        foreach ( $excelResult ['userDepartment'] as $userDepartment )
        {
            foreach ( $userDepartment ['department'] as $department )
            {
                if ($department->isNewRecord)
                {
                    $department->save ();
                }
                if ($userDepartment ['user']->isNewRecord)
                {
                    $userDepartment ['user']->save ();
                    array_push ( $newUserArray, $userDepartment ['user']->username );
                }
                $userDep = new UserDepartment ();
                $userDep->user_id = $userDepartment ['user']->user_id;
                $userDep->department_id = $department->department_id;
                $userDep->save ();
            }
        }
        
        foreach ( $excelResult ['user'] as $user )
        {
            if (in_array ( $user->username, $newUserArray ))
            {
                continue;
            }
            $user->save ();
        }
    }
    
    public static function exportContactsToZip()
    {
        $enterpriseId = Yii::app ()->user->enterprise_id;
        //get all users and departments
        $users = User::model()->findAll("permission_id = 3 and enterprise_id = $enterpriseId 
        		and contact_id <> 0 order by user_position");
        $departments = Department::model()->findAll("enterprise_id = $enterpriseId");
        
        $departmentUsers = Array();
        
        //catagorize users according to its department id.
        foreach($departments as $department)
        {
        	$depHash = Array(
        			'id' => $department->department_id,
        			'name' => $department->depatment_name,
        			'member' => array()
        			);
        	$departmentUsers["$department->department_id"] = $depHash; 
        }
        
        $defaultDep = array(
        			'id' => 0,
        			'name' => 'default department',
        			'members' => array()
        		);
		$reult['0'] = $defaultDep;
		
		$nonDummyContact = Array();
		$usedContactId = Array();
        foreach ($users as $user)
        {
			array_push($departmentUsers[$user->department_id], $user);
			array_push($usedContactId, $user->contactsTable->contact_id);
        }
        
        //address dummy contacts
        $inStr = implode(", ", $usedContactId);
        $dummyContacts =  Contacts::model()->findAll("enterprise_id = $enterpriseId and contact_id not in ($inStr)");
        //export it as xml to $HTTP_ROOT/upload/contact/unpacked and zipped to $HTTP_ROOT/upload/contact/packed,
        //xml example:
        /*
        <?xml version="1.0" encoding="utf-8"?>
        <response>
            <data>
                <contacts>
                    <department id="1" name="depname1">
                        <contact name="name1" cell="123" office="234" home="345" />
                        <contact name="name2" cell="123" office="234" home="345" />
                    </department>
                    <department id="0" name="defaultdep" >
                        <contact name="name0" cell="223" office="224" home="323" />
                    </department>
                    <department id="-1" name="dummy dep" >  
                        <contact name="dummy" cell="2323" office="1122" home="1111" />
                    </department>
                </contacts>
            </data>
        </response>
        */
        $xmlHeader = '<?xml version="1.0" encoding="utf-8"?>';
        $xmlStartTags = '<response><data><contacts>';
        $xmlEndTags = '</response></data></contacts>';
        $contentString = "";
        foreach($departmentUsers as $department)
        {
        	$contentString .= "<department id='$department->department_id' name='$department->department_name' />";
        	foreach($department as $user)
        	{
        		$contentString .= "<contact name='$user->username' cell='$user->contactsTable->contacts_cell'
        					office='$user->contactsTable->contacts_office'
        					home='$user->contactsTable->contacts_home' />";        		
        	}
        	$contentString .= "</department>";
        }
        
        require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
        $xmlContent = "$xmlHeader\n$xmlStartTags\n$contentString\n$xmlEndTags";
        $xmlFilePath = getContactsXmlDir() . $enterpriseId . ".xml";
        
        $fp = fopen($xmlFilePath, 'w');
        fwrite($fp, $xmlContent);
        fclose($fp);
        
        system("zip $xmlFilePath " . getContactsPackedDir());
        
        return;
    }
}


















