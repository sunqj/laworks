<?php

/**
 * This is the model class for table "tianyi_topic".
 *
 * The followings are the available columns in table 'tianyi_topic':
 * @property integer $topic_id
 * @property string $topic_tag
 * @property string $topic_content
 * @property integer $topic_created_gmt
 * @property integer $topic_updated_gmt
 * @property integer $topic_status
 * @property integer $enterprise_id
 * @property integer $user_id
 */
class Topic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Topic the static model class
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
		return 'tianyi_topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_content, topic_created_gmt, topic_updated_gmt, enterprise_id, user_id', 'required'),
			array('topic_created_gmt, topic_updated_gmt, topic_status, enterprise_id, user_id', 'numerical', 'integerOnly'=>true),
			array('topic_tag', 'length', 'max'=>256),
			array('topic_content', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('topic_id, topic_tag, topic_content, topic_created_gmt, topic_updated_gmt, topic_status, enterprise_id, user_id', 'safe', 'on'=>'search'),
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
			'topic_id' => 'Topic',
			'topic_tag' => 'Topic Tag',
			'topic_content' => 'Topic Content',
			'topic_created_gmt' => 'Topic Created Gmt',
			'topic_updated_gmt' => 'Topic Updated Gmt',
			'topic_status' => 'Topic Status',
			'enterprise_id' => 'Enterprise',
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

		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('topic_tag',$this->topic_tag,true);
		$criteria->compare('topic_content',$this->topic_content,true);
		$criteria->compare('topic_created_gmt',$this->topic_created_gmt);
		$criteria->compare('topic_updated_gmt',$this->topic_updated_gmt);
		$criteria->compare('topic_status',$this->topic_status);
		$criteria->compare('enterprise_id',$this->enterprise_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}