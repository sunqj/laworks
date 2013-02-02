<?php

/**
 * This is the model class for table "tianyi_build".
 *
 * The followings are the available columns in table 'tianyi_build':
 * @property integer $build_id
 * @property integer $build_date
 * @property string $build_version
 * @property string $build_comments
 * @property integer $enterprise_id
 */
class Build extends CActiveRecord
{
    public $branchId;

    /**
     * Returns the static model of the specified AR class.
     * 
     * @param string $className
     *            active record class name.
     * @return Build the static model class
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
        return 'tianyi_build';
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
                // array('build_version', 'required'),
                array (
                        'build_date, enterprise_id',
                        'numerical',
                        'integerOnly' => true 
                ),
                array (
                        'build_version',
                        'length',
                        'max' => 32 
                ),
                array (
                        'build_comments',
                        'length',
                        'max' => 60 
                ),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array (
                        'build_id, build_date, build_version, build_comments, enterprise_id, branchId',
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
                'enterpriseTable' => array (
                        self::BELONGS_TO,
                        'Enterprise',
                        'enterprise_id' 
                ) 
        );
    }

    public static function buildApk($branchName, $srcDir, $apkname, $enterpriseId)
    {
        $build_date = time ();
        $build_version = "$branchName-$build_date";
        
        $cmd = "cd $srcDir/main-apk; bash build.sh . . $enterpriseId $apkname $build_version";
        Yii::log ( "build command: $cmd" );
        $output = `$cmd`;
        
        return $output;
    }

    /**
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array (
                'build_id' => 'Build',
                'build_date' => 'Build Date',
                'build_version' => 'Build Version',
                'build_comments' => 'Build Comments',
                'enterprise_id' => 'Enterprise' 
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
        
        $criteria->compare ( 'build_id', $this->build_id );
        $criteria->compare ( 'build_date', $this->build_date );
        $criteria->compare ( 'build_version', $this->build_version, true );
        $criteria->compare ( 'build_comments', $this->build_comments, true );
        $criteria->compare ( 'enterprise_id', $this->enterprise_id );
        
        return new CActiveDataProvider ( $this, array (
                'criteria' => $criteria 
        ) );
    }
}