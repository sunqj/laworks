<?php

/**
 * This is the model class for table "tianyi_article".
 *
 * The followings are the available columns in table 'tianyi_article':
 * @property integer $article_id
 * @property string $article_tag
 * @property string $article_url
 * @property string $article_icon
 * @property integer $article_type
 * @property string $article_name
 * @property string $article_content
 * @property string $article_summary
 * @property integer $article_isbanner
 * @property integer $article_audit_gmt
 * @property integer $article_create_gmt
 * @property integer $article_update_gmt
 * @property integer $article_click_count
 * @property string $article_reject_reason
 * @property integer $article_status
 * @property integer $column_id
 * @property integer $audit_user_id
 * @property integer $enterprise_id
 * @property integer $create_user_id
 */
class Article extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * 
     * @param string $className
     *            active record class name.
     * @return Article the static model class
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
        return 'tianyi_article';
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
                array('article_name, article_content', 'required'),
                array (
                        'article_type, article_isbanner, article_audit_gmt, article_create_gmt, article_update_gmt, article_click_count, article_status, column_id, audit_user_id, enterprise_id, create_user_id',
                        'numerical',
                        'integerOnly' => true 
                ),
                array (
                        'article_tag, article_url, article_icon, article_reject_reason',
                        'length',
                        'max' => 256 
                ),
                array (
                        'article_name',
                        'length',
                        'max' => 64 
                ),
                array (
                        'article_summary',
                        'length',
                        'max' => 100 
                ),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array (
                        'article_id, article_tag, article_url, article_icon, article_type, article_name, article_content, article_summary, article_isbanner, article_audit_gmt, article_create_gmt, article_update_gmt, article_click_count, article_reject_reason, article_status, column_id, audit_user_id, enterprise_id, create_user_id',
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
                'contentTypeTable' => array (
                        self::BELONGS_TO,
                        'ContentType',
                        'article_type' 
                ),
                'contentStatusTable' => array (
                        self::BELONGS_TO,
                        'ContentStatus',
                        'article_status' 
                ),
                'columnTable' => array(
                        self::BELONGS_TO,
                        'Column',
                        'column_id',                        
                ),
                'userTable'   => array(
                        self::BELONGS_TO,
                        'User',
                        'create_user_id',
                ),
                'userTable'   => array(
                        self::BELONGS_TO,
                        'User',
                        'audit_user_id',
                ),
                
        );
    }

    /**
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array (
                'article_id' => 'Article',
                'article_tag' => 'Article Tag',
                'article_url' => 'Article Url',
                'article_icon' => 'Article Icon',
                'article_type' => 'Article Type',
                'article_name' => 'Article Name',
                'article_content' => 'Article Content',
                'article_summary' => 'Article Summary',
                'article_isbanner' => 'Article Isbanner',
                'article_audit_gmt' => 'Article Audit Gmt',
                'article_create_gmt' => 'Article Create Gmt',
                'article_update_gmt' => 'Article Update Gmt',
                'article_click_count' => 'Article Click Count',
                'article_reject_reason' => 'Article Reject Reason',
                'article_status' => 'Article Status',
                'column_id' => 'Column',
                'audit_user_id' => 'Audit User',
                'enterprise_id' => 'Enterprise',
                'create_user_id' => 'Create User' 
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
        
        $criteria->compare ( 'article_id', $this->article_id );
        $criteria->compare ( 'article_tag', $this->article_tag, true );
        $criteria->compare ( 'article_url', $this->article_url, true );
        $criteria->compare ( 'article_icon', $this->article_icon, true );
        $criteria->compare ( 'article_type', $this->article_type );
        $criteria->compare ( 'article_name', $this->article_name, true );
        $criteria->compare ( 'article_content', $this->article_content, true );
        $criteria->compare ( 'article_summary', $this->article_summary, true );
        $criteria->compare ( 'article_isbanner', $this->article_isbanner );
        $criteria->compare ( 'article_audit_gmt', $this->article_audit_gmt );
        $criteria->compare ( 'article_create_gmt', $this->article_create_gmt );
        $criteria->compare ( 'article_update_gmt', $this->article_update_gmt );
        $criteria->compare ( 'article_click_count', $this->article_click_count );
        $criteria->compare ( 'article_reject_reason', $this->article_reject_reason, true );
        $criteria->compare ( 'article_status', $this->article_status );
        $criteria->compare ( 'column_id', $this->column_id );
        $criteria->compare ( 'audit_user_id', $this->audit_user_id );
        $criteria->compare ( 'enterprise_id', $this->enterprise_id );
        $criteria->compare ( 'create_user_id', $this->create_user_id );
        
        return new CActiveDataProvider ( $this, array (
                'criteria' => $criteria 
        ) );
    }

    public function getBannerList()
    {
        return array (
                0 => '否',
                1 => '是' 
        );
    }

    public function dumpContentToFile($fileName)
    {
        $yearMonth = date ( 'Ym' );
        $absDir = getArticleStaticDirAbsolute () . "/" . $yearMonth . "/";
        if (! is_dir ( $absDir ))
        {
            mkdir ( $absDir, 0777, true );
        }
        $fullFileName = $absDir . $fileName . ".html";
        $fullFilenameFp = fopen ( $fullFileName, 'w' );
        $fileContent = 
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . 
        '<html>' . 
            '<head>' . 
                '<meta http-equiv="Content-type" content="text/html; charset=utf-8" />' . 
            '</head>' . 
            '<title>' . 
                $this->article_name .
            '</title>' . 
            '<body>' . 
                '<h1>' 
                        . $this->article_name . 
                '</h1>' .
                $this->article_content . 
            '</body>' . 
        '</html>';
        
        $ret = fwrite ( $fullFilenameFp, $fileContent );
        if ($ret < 0)
        {
            return null;
        }
        $ret = fclose ( $fullFilenameFp );
        if (! $ret)
        {
            return null;
        }
        $url = getArticleStaticDirRelative () . "/" . $yearMonth . "/" . $fileName . ".html";
        return $url;
    }

    public function beforeSave()
    {
        if (parent::beforeSave ())
        {
            require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
            $now = time ();
            $url = $this->dumpContentToFile ( $now );
            if (! $url)
            {
                return false;
            }
            
            if ($this->isNewRecord)
            {
                // add a new record
                $this->article_create_gmt = $now;
                $this->article_audit_gmt = $now;
                $this->article_update_gmt = $now;
                $this->create_user_id = Yii::app ()->user->getId ();
                $this->audit_user_id = Yii::app ()->user->getId ();
                $this->article_url = $url;
                $this->enterprise_id = Yii::app()->user->enterprise_id;
            }
            else
            {
                // update an existed record
                $this->article_update_gmt = $now;
                if ($this->article_url)
                {
                    $htmlFile = $_SERVER ['DOCUMENT_ROOT'] . $this->article_url;
                    unlink ( $htmlFile );
                }
                $this->article_url = $url;
            }
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function getBannerValue($bannerId)
    {
        return $bannerId ? '是' : '否';
    }
}
