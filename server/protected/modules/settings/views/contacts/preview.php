<?php
/* @var $this ContactsController */
/* @var $model Contacts */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Import',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
    array('label'=>'Import Contacts', 'url' => array('upload')),
);


?>

<h1>Preview Contacts</h1>


<?php 
    //echo $file;
    require Yii::app ()->getBasePath () . '/utils/utils.php';
    require Yii::app()->getBasePath() . '/lib/phpexcel/PHPExcel/IOFactory.php';
    $filePath = getExcelFileDirAbsolute() . $file;
    echo $filePath;
    $objPHPExcel = PHPExcel_IOFactory::load($filePath);
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    var_dump($sheetData);
    
?>

