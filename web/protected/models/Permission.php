<?php

/**
 * This is the model class for table "tianyi_permissions".
 *
 * The followings are the available columns in table 'tianyi_permissions':
 * @property integer $permission_id
 * @property string $permission_name
 * @property string $permission_desc
 */
class Permission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Permission the static model class
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
		return 'tianyi_permission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('permission_name, permission_desc', 'required'),
			array('permission_name, permission_desc', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('permission_id, permission_name, permission_desc', 'safe', 'on'=>'search'),
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
			'permission_id' => 'Permission',
			'permission_name' => 'Permission Name',
			'permission_desc' => 'Permission Desc',
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

		$criteria->compare('permission_id',$this->permission_id);
		$criteria->compare('permission_name',$this->permission_name,true);
		$criteria->compare('permission_desc',$this->permission_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * return permission type from database
	 */
	public function getPermissionType()
	{
		$ret_val = Permission::model()->findAll();
		return CHtml::listData($ret_val, 
				'permission_id', 'permission_name');
	}
	
	public function  getEnterprisePermissionType()
	{
		$ret_val = Permission::model()->findByAttributes('permission_id>=2');
		return CHtml::listData($ret_val, 'permission_id', 'permission_name');
	}
}











