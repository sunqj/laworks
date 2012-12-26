<?php

/**
 * This is the model class for table "tianyi_column".
 *
 * The followings are the available columns in table 'tianyi_column':
 * @property integer $column_id
 * @property string $column_icon
 * @property string $column_name
 * @property string $column_desc
 * @property integer $column_index
 * @property integer $column_create_gmt
 * @property integer $column_update_gmt
 * @property integer $column_status
 * @property integer $enterprise_id
 */
class Column extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Column the static model class
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
		return 'tianyi_column';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enterprise_id', 'required'),
			array('column_index, column_create_gmt, column_update_gmt, column_status, enterprise_id', 'numerical', 'integerOnly'=>true),
			array('column_icon', 'length', 'max'=>256),
			array('column_name', 'length', 'max'=>20),
			array('column_desc', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('column_id, column_icon, column_name, column_desc, column_index, column_create_gmt, column_update_gmt, column_status, enterprise_id', 'safe', 'on'=>'search'),
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
			'column_id' => 'Column',
			'column_icon' => 'Column Icon',
			'column_name' => 'Column Name',
			'column_desc' => 'Column Desc',
			'column_index' => 'Column Index',
			'column_create_gmt' => 'Column Create Gmt',
			'column_update_gmt' => 'Column Update Gmt',
			'column_status' => 'Column Status',
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

		$criteria->compare('column_id',$this->column_id);
		$criteria->compare('column_icon',$this->column_icon,true);
		$criteria->compare('column_name',$this->column_name,true);
		$criteria->compare('column_desc',$this->column_desc,true);
		$criteria->compare('column_index',$this->column_index);
		$criteria->compare('column_create_gmt',$this->column_create_gmt);
		$criteria->compare('column_update_gmt',$this->column_update_gmt);
		$criteria->compare('column_status',$this->column_status);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}