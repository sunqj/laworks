<?php

/**
 * This is the model class for table "tianyi_build".
 *
 * The followings are the available columns in table 'tianyi_build':
 * @property integer $build_id
 * @property integer $build_date
 * @property integer $build_type
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
                        'build_date, enterprise_id, build_type',
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
                        'build_id, build_date, build_type, build_version, build_comments, enterprise_id, branchId',
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
    
    //invoke build.sh to build client apk, following is command format and example
    
    
    //build.sh -e <enter_id> -t <theme_dir> -v <version_string> -b <branch_name> -n <app_name>
    //example:
    //build.sh -e 1 -n laworks -b branch_name -v version_string -t theme_direcory
    
    
    //above build client apk for enterprise, whose enterprise_id is "1" from branch "branch_name"
    //and the theme_dir could be relative dir to source directory or absolative directory
    //version string is used to name apk file, the final apk file should "version_string.apk"
    public static function buildApk($enterpriseId, $themeDir, $appname, $branchName, $timeStamp)
    {
        $versionString = "$branchName-$timeStamp";
        
        $srcDir = '/backup/android-workspace/devilworks-platform';
        $cmd = "cd $srcDir/main-apk; ". 
                "bash build.sh -e $enterpriseId -t . -n $appname -b $branchName -v $versionString";
        Yii::log ( "build command: $cmd" );
        
        $retCode = 0;
        $output = array();
        
        $lastLine = exec($cmd, $output, $retCode);
        
        $retVal = array( 'retval' => $retCode,
               'output' => nl2br(implode("\n", $output)));
        
        return json_encode($retVal);
        
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
                'build_type' => 'Build Type',
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
        $criteria->compare ( 'build_type', $this->build_type );
        $criteria->compare ( 'build_version', $this->build_version, true );
        $criteria->compare ( 'build_comments', $this->build_comments, true );
        $criteria->compare ( 'enterprise_id', $this->enterprise_id );
        
        return new CActiveDataProvider ( $this, array (
                'criteria' => $criteria 
        ) );
    }
    
    public function getBuildTypeList()
    {
        return Array( 0 => 'normal',
                 1 => 'force',
                );
    }
    
    public function getBuildTypeName($type)
    {
        return $type ? 'force' : 'normal';
    }
    
}