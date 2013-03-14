<?php

/**
 * This is the model class for table "tianyi_theme".
 *
 * The followings are the available columns in table 'tianyi_theme':
 * @property integer $theme_id
 * @property string $theme_name
 * @property integer $theme_o1
 * @property integer $theme_o2
 * @property integer $theme_o3
 * @property integer $theme_o4
 * @property integer $theme_o5
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
			array('theme_o1, theme_o2, theme_o3, theme_o4, theme_o5, enterprise_id', 'numerical', 'integerOnly'=>true),
			array('theme_name', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('theme_id, theme_name, theme_o1, theme_o2, theme_o3, theme_o4, theme_o5, enterprise_id', 'safe', 'on'=>'search'),
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
			'theme_o1' => 'Theme O1',
			'theme_o2' => 'Theme O2',
			'theme_o3' => 'Theme O3',
			'theme_o4' => 'Theme O4',
			'theme_o5' => 'Theme O5',
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
		$criteria->compare('theme_o1',$this->theme_o1);
		$criteria->compare('theme_o2',$this->theme_o2);
		$criteria->compare('theme_o3',$this->theme_o3);
		$criteria->compare('theme_o4',$this->theme_o4);
		$criteria->compare('theme_o5',$this->theme_o5);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}