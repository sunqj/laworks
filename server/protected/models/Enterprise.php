<?php

/**
 * This is the model class for table "tianyi_enterprise".
 *
 * The followings are the available columns in table 'tianyi_enterprise':
 * @property integer $enterprise_id
 * @property string $enterprise_name
 * @property string $enterprise_desc
 * @property string $enterprise_logo
 * @property integer $enterprise_status
 * @property integer $enterprise_audit
 * @property integer $enterprise_user_history
 * @property string $enterprise_appname
 */
class Enterprise extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * 
     * @param string $className
     *            active record class name.
     * @return Enterprise the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model ( $className );
    }
    
    /**
     *
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tianyi_enterprise';
    }
    
    /**
     *
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array (
                array (
                        'enterprise_name',
                        'required' 
                ),
                array (
                        'enterprise_status, enterprise_audit, enterprise_user_history',
                        'numerical',
                        'integerOnly' => true 
                ),
                array (
                        'enterprise_name',
                        'length',
                        'max' => 20 
                ),
                array (
                        'enterprise_desc, enterprise_logo',
                        'length',
                        'max' => 256 
                ),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array (
                        'enterprise_id, enterprise_appname, enterprise_name, enterprise_desc, enterprise_logo, enterprise_status, enterprise_audit, enterprise_user_history',
                        'safe',
                        'on' => 'search' 
                ) 
        );
    }
    
    /**
     *
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array (
                'auditLink' => Array(self::BELONGS_TO, 'RoleStatus', 'enterprise_audit'),
                'userHistoryLink' => Array(self::BELONGS_TO, 'RoleStatus', 'enterprise_user_history'),
                );
    }
    
    /**
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array (
                'enterprise_id' => 'Enterprise',
                'enterprise_name' => 'Enterprise Name',
                'enterprise_desc' => 'Enterprise Desc',
                'enterprise_logo' => 'Enterprise Logo',
                'enterprise_status' => 'Enterprise Status',
                'enterprise_audit' => 'Enterprise Audit',
                'enterprise_appname' => 'Enterprise Appname',
                'enterprise_user_history' => 'Enterprise User History' 
        );
    }
    
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * 
     * @return CActiveDataProvider the data provider that can return the models
     *         based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria ();
        
        $criteria->compare ( 'enterprise_id', '<> 0' );
        $criteria->compare ( 'enterprise_name', $this->enterprise_name, true );
        $criteria->compare ( 'enterprise_appname', $this->enterprise_appname, true );
        $criteria->compare ( 'enterprise_desc', $this->enterprise_desc, true );
        $criteria->compare ( 'enterprise_logo', $this->enterprise_logo, true );
        $criteria->compare ( 'enterprise_status', $this->enterprise_status );
        $criteria->compare ( 'enterprise_audit', $this->enterprise_audit );
        $criteria->compare ( 'enterprise_user_history', $this->enterprise_user_history );
        
        return new CActiveDataProvider ( $this, array (
                'criteria' => $criteria 
        ) );
    }
    
    public function afterSave()
    {
        require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
        
        $dirs = implode(" ", getEnterpriseDirsAbsolute($this->enterprise_id));
        Yii::log("dirs to make: $dirs");
        system("rm -fr $dirs; mkdir -p $dirs");
        
    }
    
    public function getEnterpriseList()
    {
        $enterpriseList = Enterprise::model ()->findAll ( $condition = 'enterprise_id > 0' );
        return CHtml::listData ( $enterpriseList, 'enterprise_id', 'enterprise_name' );
    }
}
