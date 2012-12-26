<?php

/**
 * This is the model class for table "tianyi_history".
 *
 * The followings are the available columns in table 'tianyi_history':
 * @property integer $history_id
 * @property integer $history_gmt
 * @property string $history_ip
 * @property integer $user_id
 */
class History extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return History the static model class
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
		return 'tianyi_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('history_gmt, user_id', 'required'),
			array('history_gmt, user_id', 'numerical', 'integerOnly'=>true),
			array('history_ip', 'length', 'max'=>235),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('history_id, history_gmt, history_ip, user_id', 'safe', 'on'=>'search'),
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
			'history_id' => 'History',
			'history_gmt' => 'History Gmt',
			'history_ip' => 'History Ip',
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

		$criteria->compare('history_id',$this->history_id);
		$criteria->compare('history_gmt',$this->history_gmt);
		$criteria->compare('history_ip',$this->history_ip,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}