<?php

/**
 * This is the model class for table "tianyi_theme".
 *
 * The followings are the available columns in table 'tianyi_theme':
 * @property integer $theme_id
 * @property string $theme_name
 * @property integer $enterprise_id
 */
class Theme extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Theme the static model class
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
		return 'tianyi_theme';
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
			array('theme_name', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('theme_id, theme_name, enterprise_id', 'safe', 'on'=>'search'),
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
			'theme_id' => 'Theme',
			'theme_name' => 'Theme Name',
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

		$criteria->compare('theme_id',$this->theme_id);
		$criteria->compare('theme_name',$this->theme_name,true);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}