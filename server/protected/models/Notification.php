<?php

/**
 * This is the model class for table "tianyi_notification".
 *
 * The followings are the available columns in table 'tianyi_notification':
 * @property integer $notification_id
 * @property string $notification_name
 * @property string $notification_desc
 * @property integer $notification_audit_gmt
 * @property integer $notification_create_gmt
 * @property integer $notification_status
 * @property integer $department_id
 * @property integer $audit_user_id
 * @property integer $enterprise_id
 * @property integer $create_user_id
 */
class Notification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notification the static model class
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
		return 'tianyi_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notification_name, notification_desc, department_id, enterprise_id, create_user_id', 'required'),
			array('notification_audit_gmt, notification_create_gmt, notification_status, department_id, audit_user_id, enterprise_id, create_user_id', 'numerical', 'integerOnly'=>true),
			array('notification_name', 'length', 'max'=>64),
			array('notification_desc', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('notification_id, notification_name, notification_desc, notification_audit_gmt, notification_create_gmt, notification_status, department_id, audit_user_id, enterprise_id, create_user_id', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'notification_id' => 'Notification',
			'notification_name' => 'Notification Name',
			'notification_desc' => 'Notification Desc',
			'notification_audit_gmt' => 'Notification Audit Gmt',
			'notification_create_gmt' => 'Notification Create Gmt',
			'notification_status' => 'Notification Status',
			'department_id' => 'Department',
			'audit_user_id' => 'Audit User',
			'enterprise_id' => 'Enterprise',
			'create_user_id' => 'Create User',
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

		$criteria->compare('notification_id',$this->notification_id);
		$criteria->compare('notification_name',$this->notification_name,true);
		$criteria->compare('notification_desc',$this->notification_desc,true);
		$criteria->compare('notification_audit_gmt',$this->notification_audit_gmt);
		$criteria->compare('notification_create_gmt',$this->notification_create_gmt);
		$criteria->compare('notification_status',$this->notification_status);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('audit_user_id',$this->audit_user_id);
		$criteria->compare('enterprise_id',$this->enterprise_id);
		$criteria->compare('create_user_id',$this->create_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}