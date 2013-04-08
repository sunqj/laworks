<?php

/**
 * This is the model class for table "tianyi_department".
 *
 * The followings are the available columns in table 'tianyi_department':
 * @property integer $department_id
 * @property string $department_name
 * @property string $department_desc
 * @property integer $department_status
 * @property integer $enterprise_id
 */
class Department extends CActiveRecord
{
    public $userList = Array();
    // get user list for this department 
    public function getDepartmentUserList()
    {
        if(!$this->department_id)
        {
            return null;
        }
        $userList = UserDepartment::model()->findAll("department_id = $this->department_id");
        return CHtml::listData($userList, 'user_id','username');
    }
    
    // get user name string for this department
    // eg: user1,user2,user3...
    
    public function getDepartmentUserNameString()
    {
    	if(!$this->department_id)
    	{
    		return null;
    	}
        $userList = $this->getDepartmentUserList();
        if(!$userList)
        {
            return null;
        }
        return implode(",", $userList);
    }
    
    //get user id list for this department
    //eg: (3, 4, 5)
    public function getDepartmentUserIdList()
    {
        if(!$this->department_id)
        {
            return null;
        }
        $userIdList = Array();
        $userList = UserDepartment::model()->findAll("department_id = $this->department_id");
        foreach($userList as $user)
        {
            array_push($userIdList, $user->user_id);
        }
        return $userIdList;
    }
    
    //all relations in user_department table should be deleted before delete the department record
    public function beforeDelete()
    {
        $userIdList = UserDepartment::model()->deleteAll("department_id = $this->department_id");
        return true;
    }
    
    //should create relation after create the department
    public function afterSave()
    {
        //here is a performance issue, we should make a little tuning here.
        //we should insert create all new record with one shot instead of one by one.
        foreach($this->userList as $userid)
        {
            $userDepartment = new UserDepartment;
            $userDepartment->user_id = $userid;
            $userDepartment->department_id = $this->department_id;
            $userDepartment->save();
        }
        return true;
    }

    private function hasUser($userId)
    {
    	$userDepartment = UserDepartment::model()->find("user_id = $userId and department_id = $this->department_id");
    	return !($userDepartment == null);
    }
    
    public function beforeUpdate()
    {
        Yii::log("before update, user list:" . implode(",", $this->userList));
        $userIdList = UserDepartment::model()->deleteAll("department_id = $this->department_id");
        //here is a performance issue, we should make a little tuning here.
        //we should insert create all new record with one shot instead of one by one.
        foreach($this->userList as $userid)
        {
        	if($this->hasUser($userId))
        	{
        		continue;
        	}
            $userDepartment = new UserDepartment;
            $userDepartment->user_id = $userid;
            $userDepartment->department_id = $this->department_id;
            $userDepartment->save();
        }
        return true;
    }
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Department the static model class
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
		return 'tianyi_department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('department_name', 'required'),
			array('department_status, enterprise_id', 'numerical', 'integerOnly'=>true),
			array('department_name', 'length', 'max'=>64),
			array('department_desc', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('department_id, department_name, department_desc, department_status, enterprise_id, userList', 'safe', 'on'=>'search'),
		    array('userList', 'safe', 'on'=>'insert'),
		    array('userList', 'safe', 'on'=>'update'),
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
		        'roleStatusTable' => array(self::BELONGS_TO, 'RoleStatus', 'department_status'),
		        'userTable' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'department_id' => 'Department',
			'department_name' => 'Department Name',
			'department_desc' => 'Department Desc',
			'department_status' => 'Department Status',
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

		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('department_name',$this->department_name,true);
		$criteria->compare('department_desc',$this->department_desc,true);
		$criteria->compare('department_status',$this->department_status);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
