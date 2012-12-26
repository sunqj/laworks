<?php

/**
 * This is the model class for table "tianyi_vote".
 *
 * The followings are the available columns in table 'tianyi_vote':
 * @property integer $vote_id
 * @property string $vote_url
 * @property integer $vote_type
 * @property string $vote_name
 * @property string $vote_icon
 * @property string $vote_summary
 * @property string $vote_content
 * @property integer $vote_audit_userid
 * @property integer $vote_create_userid
 * @property integer $vote_audit_time_gmt
 * @property integer $vote_create_time_gmt
 * @property integer $vote_status
 * @property integer $enterprise_id
 */
class Vote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vote the static model class
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
		return 'tianyi_vote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vote_name, vote_content, vote_audit_userid, vote_create_userid, enterprise_id', 'required'),
			array('vote_type, vote_audit_userid, vote_create_userid, vote_audit_time_gmt, vote_create_time_gmt, vote_status, enterprise_id', 'numerical', 'integerOnly'=>true),
			array('vote_url, vote_name, vote_icon, vote_content', 'length', 'max'=>256),
			array('vote_summary', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('vote_id, vote_url, vote_type, vote_name, vote_icon, vote_summary, vote_content, vote_audit_userid, vote_create_userid, vote_audit_time_gmt, vote_create_time_gmt, vote_status, enterprise_id', 'safe', 'on'=>'search'),
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
			'vote_id' => 'Vote',
			'vote_url' => 'Vote Url',
			'vote_type' => 'Vote Type',
			'vote_name' => 'Vote Name',
			'vote_icon' => 'Vote Icon',
			'vote_summary' => 'Vote Summary',
			'vote_content' => 'Vote Content',
			'vote_audit_userid' => 'Vote Audit Userid',
			'vote_create_userid' => 'Vote Create Userid',
			'vote_audit_time_gmt' => 'Vote Audit Time Gmt',
			'vote_create_time_gmt' => 'Vote Create Time Gmt',
			'vote_status' => 'Vote Status',
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

		$criteria->compare('vote_id',$this->vote_id);
		$criteria->compare('vote_url',$this->vote_url,true);
		$criteria->compare('vote_type',$this->vote_type);
		$criteria->compare('vote_name',$this->vote_name,true);
		$criteria->compare('vote_icon',$this->vote_icon,true);
		$criteria->compare('vote_summary',$this->vote_summary,true);
		$criteria->compare('vote_content',$this->vote_content,true);
		$criteria->compare('vote_audit_userid',$this->vote_audit_userid);
		$criteria->compare('vote_create_userid',$this->vote_create_userid);
		$criteria->compare('vote_audit_time_gmt',$this->vote_audit_time_gmt);
		$criteria->compare('vote_create_time_gmt',$this->vote_create_time_gmt);
		$criteria->compare('vote_status',$this->vote_status);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}