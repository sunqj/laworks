<?php

/**
 * This is the model class for table "tianyi_option".
 *
 * The followings are the available columns in table 'tianyi_option':
 * @property integer $option_id
 * @property integer $option_count
 * @property string $option_content
 * @property integer $vote_id
 */
class Option extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Option the static model class
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
		return 'tianyi_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vote_id', 'required'),
			array('option_count, vote_id', 'numerical', 'integerOnly'=>true),
			array('option_content', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('option_id, option_count, option_content, vote_id', 'safe', 'on'=>'search'),
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
			'option_id' => 'Option',
			'option_count' => 'Option Count',
			'option_content' => 'Option Content',
			'vote_id' => 'Vote',
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

		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('option_count',$this->option_count);
		$criteria->compare('option_content',$this->option_content,true);
		$criteria->compare('vote_id',$this->vote_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}