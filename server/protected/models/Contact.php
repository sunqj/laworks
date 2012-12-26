<?php

/**
 * This is the model class for table "tianyi_contact".
 *
 * The followings are the available columns in table 'tianyi_contact':
 * @property integer $contact_id
 * @property string $contact_name
 * @property integer $contact_index
 * @property string $contact_number
 * @property string $contact_position
 * @property integer $user_id
 */
class Contact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contact the static model class
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
		return 'tianyi_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_name, contact_number, user_id', 'required'),
			array('contact_index, user_id', 'numerical', 'integerOnly'=>true),
			array('contact_name, contact_position', 'length', 'max'=>256),
			array('contact_number', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_id, contact_name, contact_index, contact_number, contact_position, user_id', 'safe', 'on'=>'search'),
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
			'contact_id' => 'Contact',
			'contact_name' => 'Contact Name',
			'contact_index' => 'Contact Index',
			'contact_number' => 'Contact Number',
			'contact_position' => 'Contact Position',
			'user_id' => 'User',
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

		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_index',$this->contact_index);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('contact_position',$this->contact_position,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}