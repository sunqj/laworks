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
}