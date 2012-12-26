<?php

/**
 * This is the model class for table "tianyi_reply".
 *
 * The followings are the available columns in table 'tianyi_reply':
 * @property integer $reply_id
 * @property string $reply_content
 * @property integer $reply_create_gmt
 * @property integer $topic_id
 * @property integer $user_id
 */
class Reply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reply the static model class
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
		return 'tianyi_reply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reply_content, reply_create_gmt, topic_id, user_id', 'required'),
			array('reply_create_gmt, topic_id, user_id', 'numerical', 'integerOnly'=>true),
			array('reply_content', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reply_id, reply_content, reply_create_gmt, topic_id, user_id', 'safe', 'on'=>'search'),
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
			'reply_id' => 'Reply',
			'reply_content' => 'Reply Content',
			'reply_create_gmt' => 'Reply Create Gmt',
			'topic_id' => 'Topic',
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

		$criteria->compare('reply_id',$this->reply_id);
		$criteria->compare('reply_content',$this->reply_content,true);
		$criteria->compare('reply_create_gmt',$this->reply_create_gmt);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}