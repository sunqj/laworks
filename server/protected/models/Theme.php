<?php

/**
 * This is the model class for table "tianyi_theme".
 *
 * The followings are the available columns in table 'tianyi_theme':
 * @property integer $theme_id
 * @property string $theme_name
 * @property integer $theme_c01
 * @property integer $theme_c02
 * @property integer $theme_c03
 * @property integer $theme_c04
 * @property integer $theme_c05
 * @property integer $theme_c06
 * @property integer $theme_c07
 * @property integer $theme_c08
 * @property integer $theme_c09
 * @property integer $theme_c10
 * @property integer $theme_c11
 * @property integer $theme_c12
 * @property integer $enterprise_id
 */
class Theme extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Theme the static model class
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
		return 'tianyi_theme';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('', 'required'),
			array('theme_c01, theme_c02, theme_c03, theme_c04, theme_c05, theme_c06, theme_c07, theme_c08, 
			        theme_c09, theme_c10, theme_c11, theme_c12, enterprise_id', 'numerical', 'integerOnly'=>true),
			array('theme_name', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('theme_id, theme_name, theme_c01, theme_c02, theme_c03, theme_c04, theme_c05, theme_c06, 
			        theme_c07, theme_c08, theme_c09, theme_c10, theme_c11, theme_c12, enterprise_id', 
			        'safe', 'on'=>'search'),
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

	
	public function afterSave()
	{
	    require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
	    $themeDir = getThemeDirAbsolute();
	    $unpackedDir = "{$themeDir}unpacked/";
	    $packedDir = "{$themeDir}packed/";
	    
	    $mkdirCmd = "mkdir {$unpackedDir}$this->theme_id";
	    $zipCmd = "cd {$themeDir}; zip {$packedDir}$this->theme_id.zip *.png";
	    $mvCmd = "mv {$themeDir}*.png {$unpackedDir}$this->theme_id";
	    
	    $cmdList = "$mkdirCmd; $zipCmd; $mvCmd";
	    
	    Yii::log("create theme $this->theme_id, command: $cmdList");
	    //mkdir for theme
	    system($cmdList);
        
	    for($i = 1; $i <= 12; ++$i)
	    {
	        $columnId = $this[$i > 9 ? "theme_c$i" : "theme_c0$i"];
	         
	        if($columnId <= 0)
	        {
	            continue;
	        }
	        $column = Column::model()->findByPk($columnId);
	        $column->column_index = $i;
	        $column->save();
	    }
	    
	    return true;
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'theme_id' => 'Theme',
			'theme_name' => 'Theme Name',
			'theme_c01' => 'Theme C01',
			'theme_c02' => 'Theme C02',
			'theme_c03' => 'Theme C03',
			'theme_c04' => 'Theme C04',
			'theme_c05' => 'Theme C05',
			'theme_c06' => 'Theme C06',
			'theme_c07' => 'Theme C07',
			'theme_c08' => 'Theme C08',
			'theme_c09' => 'Theme C09',
			'theme_c10' => 'Theme C10',
			'theme_c11' => 'Theme C11',
			'theme_c12' => 'Theme C12',
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

		$criteria->compare('theme_id',$this->theme_id);
		$criteria->compare('theme_name',$this->theme_name,true);
		$criteria->compare('theme_c01',$this->theme_c01);
		$criteria->compare('theme_c02',$this->theme_c02);
		$criteria->compare('theme_c03',$this->theme_c03);
		$criteria->compare('theme_c04',$this->theme_c04);
		$criteria->compare('theme_c05',$this->theme_c05);
		$criteria->compare('theme_c06',$this->theme_c06);
		$criteria->compare('theme_c07',$this->theme_c07);
		$criteria->compare('theme_c08',$this->theme_c08);
		$criteria->compare('theme_c09',$this->theme_c09);
		$criteria->compare('theme_c10',$this->theme_c10);
		$criteria->compare('theme_c11',$this->theme_c11);
		$criteria->compare('theme_c12',$this->theme_c12);
		$criteria->compare('enterprise_id',$this->enterprise_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}