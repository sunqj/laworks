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
 * @property integer $enterprise_id
 */
class Contacts extends CActiveRecord
{
    // get all contacts belongs to same enterprise
    public function getEnterpriseContactsList($enterpriseId)
    {
        $contactsList = Contacts::model()->findAll("enterprise_id = $enterpriseId");
        $ret_val = CHtml::listData($contactsList, 'contacts_id', 'contacts_name');
        return $ret_val;
    }
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tianyi_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('contacts_name', 'required'),
			array('enterprise_id', 'numerical', 'integerOnly'=>true),
			array('contacts_name', 'length', 'max'=>20),
			array('contacts_cell, contacts_hometel, contacts_officetel', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contacts_id, contacts_name, contacts_cell, contacts_hometel, contacts_officetel, enterprise_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	//set user->contacts_id to zero before delete contacts.
	public function beforeDelete()
	{
	    User::model()->updateAll(array("contacts_id" => 0), "contacts_id = $this->contacts_id");
	    return true;
	}
	
	//set enterprise_id for record
	public function  beforeSave()
	{
	    if(!parent::beforeSave())
	    {
	        return false;
	    }
	     
	    if($this->isNewRecord)
	    {
	        $this->enterprise_id = Yii::app()->user->enterprise_id;
	    }
	    
	    return true;
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'contacts_id' => 'Contacts',
			'contacts_name' => 'Contacts Name',
			'contacts_cell' => 'Contacts Cell',
			'contacts_hometel' => 'Contacts Hometel',
			'contacts_officetel' => 'Contacts Officetel',
			'enterprise_id' => 'Enterprise',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('contacts_id',$this->contacts_id);
		$criteria->compare('contacts_name',$this->contacts_name,true);
		$criteria->compare('contacts_cell',$this->contacts_cell,true);
		$criteria->compare('contacts_hometel',$this->contacts_hometel,true);
		$criteria->compare('contacts_officetel',$this->contacts_officetel,true);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function parseExcelFileToArray($file)
	{
	    require Yii::app ()->getBasePath () . '/utils/utils.php';
	    require Yii::app()->getBasePath() . '/lib/phpexcel/PHPExcel/IOFactory.php';
	    
	    $filePath = getExcelFileDirAbsolute() . $file;
	    $objPHPExcel = PHPExcel_IOFactory::load($filePath);
	    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	   
	    //remove header line.
	    array_shift($sheetData);
	    
	    //return $sheetData;
	    //following arrays should be returned.
	    $userArray = Array();
	    $cellArray = Array();
	    $badLineArray = Array();
	    $contactsArray = Array();
	    $newDepartmentArray = Array();
	    $duplicateLineArray = Array();
	    $userDepartmentArray = Array();
	    
	    //temp arrays
	    $excelDepartmentArray = Array();
	    
	    //temp values
	    $enterpriseId = Yii::app()->user->enterprise_id;
	    $permissionId = '4'; //all users are cell phone user.
	    $enterpriseLoginType = 0; // login type 0 => IMSI, 1 => username/password
	    
	    //line number
	    $lineIndex = 2;
	    $userAddType = 0; //user type 0 => only add user, 1 => only add contacts, 2=> add user and contacts 
	    
	    define('UATYPE_USER_ONLY', '0');
	    define('UATYPE_CONTACTS_ONLY', '1');
	    define('UATYPE_USER_CONTACTS', '2');
	    //parse excel file line by line
	    //
	    //example
        //A         B            C           D          E        F           G           H
        //联系人姓名  手机号码      办公室电话    家庭电话	    排序编号  特别数据	    部门名        1
        //Leo       18049229109	 87401234    67401234   0        1111111    软件部,硬件部  2

	    foreach($sheetData as $line)
	    {
	        //--data initialization
	        //contacts       
	        $contacts = new Contacts;
	        $contacts->contacts_name = $line['A'] ? $line['A'] : $line['B'];
	        $contacts->contacts_cell = $line['B'];
	        $contacts->contacts_officetel     = $line['C'];
	        $contacts->contacts_hometel       = $line['D'];
	        $contacts->enterprise_id = $enterpriseId;
	        
	        //users
	        $user = new User;
	        $user->username         = $line['B'];
	        $user->password         = $line['B'];
	        $user->permission_id    = $permissionId;
	        $user->enterprise_id    = $enterpriseId;
	        $user->user_extra       = $line['F'];
	        $user->user_position    = $line['E'];
	        
	        // cellphone duplicate
	        if(isset($cellArray[strval($line['B'])]))
	        {
	            $duplicateLineArray[$lineIndex] = strval($line['B']);
	            ++$lineIndex;
	            continue;
	        }
	        else
	        {
	            if(trim($line['B']) != null)
	            {
	                $cellArray[strval($line['B'])] = $lineIndex;
	            }
	        }
	        

	        $lineDepartment = explode(',', $line['G']);
	        
	        if(trim(strval($line['H'])) != "")
	        {
	            $userAddType = strval($line['H']);
	        }
	        //--data initialization
	        

	        //---data verification and trim
	        
	        // add user only
	        if($userAddType == UATYPE_USER_ONLY)
	        {
	            if(trim($line['B']) == null)
	            {
	                $badLineArray["$lineIndex"] = 'username is null. username:' . $line['B'] ;
	                ++$lineIndex;
	                continue;
	            }
	            
	            $userArray[$lineIndex] = $user;
	            
	            array_merge($excelDepartmentArray, $lineDepartment);
	            $userDepartmentArray["$lineIndex"] = $line['G'];
	            
	            ++$lineIndex;
	            continue;
	        }
	        // add contacts only
	        elseif($userAddType == UATYPE_CONTACTS_ONLY)
	        {
	            if(trim($line['B']) == null && trim($line['C']) == null 
	                    && trim($line['D']) == null)
	            {
	                $badLineArray["$lineIndex"] = 'cell, officetel and hometel are all null. username:' . $line['B'] ;
	                ++$lineIndex;
	                continue;
	            }
	            
	            $contactsArray[$lineIndex] = $contacts;
	            ++$lineIndex;
	            continue;
	        }
                // add user and contacts
            elseif ($userAddType == UATYPE_USER_CONTACTS)
            {
                if ((trim ( $user ['username'] ) == null) || 
                    (trim ( $line ['B'] ) == null && trim ( $line ['C'] ) == null && trim ( $line ['D'] ) == null))
                {
                    $badLineArray [$lineIndex] = 'username or all cell, officetel or hometel are null.  username:' . $line['B'] ;
                    ++ $lineIndex;
                    continue;
                }
                
                // user table and contacts table
                $contactsArray["$lineIndex"] = $contacts;
                $userArray["$lineIndex"] = $user;
                
                // department table and user_department table
                array_merge($excelDepartmentArray, $lineDepartment);
                $userDepartmentArray["$lineIndex"] = $line['G'];
                
                ++$lineIndex;
                continue;
            }
	        // others
	        else 
	        {
	            
	        }
	    }

	    $retVal = array(
	            'user'            => $userArray,
	            'cell'            => $cellArray,
	            'contacts'        => $contactsArray,
	            'department'      => $newDepartmentArray,
	            'userDepartment'  => $userDepartmentArray,
	            'duplicateLine'   => $duplicateLineArray,
	            'badLine'         => $badLineArray,
	            );
	    
	    return $retVal;
	}
}




















