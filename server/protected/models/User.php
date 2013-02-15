<?php

/**
 * This is the model class for table "tianyi_user".
 *
 * The followings are the available columns in table 'tianyi_user':
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $user_other
 * @property string $user_extra
 * @property string $user_image
 * @property string $user_email
 * @property string $user_realname
 * @property integer $user_position
 * @property integer $user_login_count
 * @property integer $user_last_login_time
 * @property integer $user_last_check_time
 * @property integer $user_status
 * @property integer $permission_id
 * @property integer $enterprise_id
 * @property integer $contacts_id
 */
class User extends CActiveRecord
{
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'tianyi_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, permission_id', 'required'),
			array('user_position, user_login_count, user_last_login_time, user_last_check_time, user_status, permission_id, 
			        enterprise_id, contacts_id', 'numerical', 'integerOnly'=>true),
			array('username, password, user_realname', 'length', 'max'=>20),
		    array('user_email', 'length', 'max'=>32),
			array('user_other, user_extra', 'length', 'max'=>256),
			array('user_image', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, password, user_other, user_extra, user_image, user_email,  
			        user_realname, user_position, user_login_count, user_last_login_time, user_last_check_time, 
			        user_status, permission_id, enterprise_id, contacts_id', 'safe', 'on'=>'search'),
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
				'enterpriseTable' => array(self::BELONGS_TO, 'Enterprise', 'enterprise_id'),
				'permissionTable' => array(self::BELONGS_TO, 'Permission', 'permission_id'),
		        'roleStatusTable' => array(self::BELONGS_TO, 'RoleStatus', 'user_status'),
		        'contactsTable' => array(self::BELONGS_TO, 'Contacts', 'contacts_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Username',
			'password' => 'Password',
			'user_other' => 'User Other',
			'user_extra' => 'User Extra',
			'user_image' => 'User Image',
			'user_email' => 'User Email',
			'user_realname' => 'User Realname',
			'user_position' => 'User Position',
			'user_login_count' => 'User Login Count',
			'user_last_login_time' => 'User Last Login Time',
			'user_last_check_time' => 'User Last Check Time',
			'user_status' => 'User Status',
			'permission_id' => 'Permission',
			'enterprise_id' => 'Enterprise',
		    'contacts_id' => 'Contacts',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_other',$this->user_other,true);
		$criteria->compare('user_extra',$this->user_extra,true);
		$criteria->compare('user_image',$this->user_image,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_realname',$this->user_realname,true);
		$criteria->compare('user_position',$this->user_position);
		$criteria->compare('user_login_count',$this->user_login_count);
		$criteria->compare('user_last_login_time',$this->user_last_login_time);
		$criteria->compare('user_last_check_time',$this->user_last_check_time);
		$criteria->compare('user_status',$this->user_status);
		if(Yii::app()->user->id == 0)
		{
		    $criteria->compare('permission_id','1');
		    $criteria->compare('enterprise_id', $this->enterprise_id);
		}
		else
		{
		    $criteria->compare('enterprise_id',"=$this->enterprise_id");
		    $criteria->compare('permission_id', $this->permission_id);
		    $criteria->compare('permission_id', '>1');
		}
		$criteria->compare('contacts_id',$this->contacts_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
	    if(!parent::beforeSave())
	    {
	        return false;
	    }

        if ($this->isNewRecord)
        {
            // add a new record
            if(Yii::app()->user->Id != 0)
            {
                $this->enterprise_id = Yii::app()->user->enterprise_id;
            }                
        }
        return true;
	}
	
	public function getEnterpriseAdminList($enterpriseId)
	{
	    $userList = User::model()->findAll("enterprise_id = $enterpriseId and permission_id = 1");
	    return CHtml::listData($userList, 'user_id', 'username');
	}
	
	public function getEnterpriseUserList($enterpriseId)
	{
	    $userList = User::model()->findAll("enterprise_id = $enterpriseId and permission_id > 1");
	    return CHtml::listData($userList, 'user_id', 'username');
	}
	
	public function getEnterprisePhoneUserList($enterpriseId)
	{
	    $userList = User::model()->findAll("enterprise_id = $enterpriseId and permission_id = 3");
	    return CHtml::listData($userList, 'user_id', 'username');
	}
	
	
	public static function getUserByName($username)
	{
	    $ret = User::model()->findByAttributes(Array("username" => $username));
	    return $ret;
	}
}