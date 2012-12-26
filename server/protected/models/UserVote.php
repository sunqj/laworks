<?php

/**
 * This is the model class for table "tianyi_user_vote".
 *
 * The followings are the available columns in table 'tianyi_user_vote':
 * @property integer $dummy_id
 * @property integer $vote_id
 * @property integer $user_id
 * @property integer $option_id
 */
class UserVote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserVote the static model class
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
		return 'tianyi_user_vote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vote_id, user_id, option_id', 'required'),
			array('vote_id, user_id, option_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dummy_id, vote_id, user_id, option_id', 'safe', 'on'=>'search'),
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
			'dummy_id' => 'Dummy',
			'vote_id' => 'Vote',
			'user_id' => 'User',
			'option_id' => 'Option',
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

		$criteria->compare('dummy_id',$this->dummy_id);
		$criteria->compare('vote_id',$this->vote_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('option_id',$this->option_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}