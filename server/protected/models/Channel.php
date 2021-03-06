<?php

/**
 * This is the model class for table "tianyi_channel".
 *
 * The followings are the available columns in table 'tianyi_channel':
 * @property integer $channel_id
 * @property string $channel_name
 * @property string $channel_desc
 * @property string $channel_icon
 * @property integer $channel_index
 * @property integer $role_status_id
 */
class Channel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Channel the static model class
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
		return 'tianyi_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_name', 'required'),
			array('channel_index, role_status_id', 'numerical', 'integerOnly'=>true),
			array('channel_name', 'length', 'max'=>20),
			array('channel_desc', 'length', 'max'=>100),
			array('channel_icon', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('channel_id, channel_name, channel_desc, channel_icon, channel_index, role_status_id', 'safe', 'on'=>'search'),
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
		        'roleStatusTable' => array(self::BELONGS_TO, 'RoleStatus', 'role_status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'channel_id' => 'Channel',
			'channel_name' => 'Channel Name',
			'channel_desc' => 'Channel Desc',
			'channel_icon' => 'Channel Icon',
			'channel_index' => 'Channel Index',
			'role_status_id' => 'Role Status',
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

		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('channel_name',$this->channel_name,true);
		$criteria->compare('channel_desc',$this->channel_desc,true);
		$criteria->compare('channel_icon',$this->channel_icon,true);
		$criteria->compare('channel_index',$this->channel_index);
		$criteria->compare('role_status_id',$this->role_status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getAvailableChannelList()
	{
	    $allChannelList = Channel::model()->findAll('role_status_id = 0');
	    return CHtml::listData($allChannelList, 'channel_id', 'channel_name');
	}
}