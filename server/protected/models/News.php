<?php

/**
 * This is the model class for table "tianyi_news".
 *
 * The followings are the available columns in table 'tianyi_news':
 * @property integer $news_id
 * @property string $news_url
 * @property string $news_name
 * @property string $news_icon
 * @property integer $news_type
 * @property string $news_content
 * @property string $news_summary
 * @property integer $news_audit_gmt
 * @property integer $news_create_gmt
 * @property integer $news_update_gmt
 * @property integer $news_click_count
 * @property integer $news_status
 * @property integer $channel_id
 * @property integer $audit_user_id
 * @property integer $create_user_id
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'tianyi_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_name, news_content, channel_id', 'required'),
			array('news_type, news_audit_gmt, news_create_gmt, news_update_gmt, news_click_count, news_status, channel_id, audit_user_id, create_user_id', 'numerical', 'integerOnly'=>true),
			array('news_url, news_icon', 'length', 'max'=>256),
			array('news_name', 'length', 'max'=>64),
			array('news_summary', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('news_id, news_url, news_name, news_icon, news_type, news_content, news_summary, news_audit_gmt, news_create_gmt, news_update_gmt, news_click_count, news_status, channel_id, audit_user_id, create_user_id', 'safe', 'on'=>'search'),
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
			'news_id' => 'News',
			'news_url' => 'News Url',
			'news_name' => 'News Name',
			'news_icon' => 'News Icon',
			'news_type' => 'News Type',
			'news_content' => 'News Content',
			'news_summary' => 'News Summary',
			'news_audit_gmt' => 'News Audit Gmt',
			'news_create_gmt' => 'News Create Gmt',
			'news_update_gmt' => 'News Update Gmt',
			'news_click_count' => 'News Click Count',
			'news_status' => 'News Status',
			'channel_id' => 'Channel',
			'audit_user_id' => 'Audit User',
			'create_user_id' => 'Create User',
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

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('news_url',$this->news_url,true);
		$criteria->compare('news_name',$this->news_name,true);
		$criteria->compare('news_icon',$this->news_icon,true);
		$criteria->compare('news_type',$this->news_type);
		$criteria->compare('news_content',$this->news_content,true);
		$criteria->compare('news_summary',$this->news_summary,true);
		$criteria->compare('news_audit_gmt',$this->news_audit_gmt);
		$criteria->compare('news_create_gmt',$this->news_create_gmt);
		$criteria->compare('news_update_gmt',$this->news_update_gmt);
		$criteria->compare('news_click_count',$this->news_click_count);
		$criteria->compare('news_status',$this->news_status);
		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('audit_user_id',$this->audit_user_id);
		$criteria->compare('create_user_id',$this->create_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave()
	{
	    if(parent::beforeSave())
	    {
	        $now = time();
	        if($this->isNewRecord)
	        {
	            // add a new record

	            $this->news_create_gmt = $now;
	            $this->news_audit_gmt = $now;
	            $this->news_update_gmt = $now;
	            $this->create_user_id = Yii::app()->user->getId();
	            $this->audit_user_id = Yii::app()->user->getId();
	        }
	        else
	        {
	            // update an existed record
	            $this->news_update_gmt = $now;
	        }
	        return true;
	    }
	    else
	    {
	         
	        return false;
	    }
	}
}