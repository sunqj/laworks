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
    $ret_val = Contacts::parseExcelFileToArray($file);

        var_dump($ret_val);
        echo "</br></br>";

?>

