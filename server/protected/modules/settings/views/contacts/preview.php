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
    $retVal = Contacts::parseExcelFileToArray($file);

    //var_dump($retVal['user']);
    //var_dump($retVal['user']);
    echo "</br></br>";
    var_dump($retVal['cell']);
    echo "</br></br>";
    //var_dump($retVal['contacts']);
    //echo "</br></br>";
    var_dump($retVal['department']);
    echo "</br></br>";
    var_dump($retVal['userDepartment']);
    echo "</br></br>";
    var_dump($retVal['duplicateLine']);
    echo "</br></br>";
    var_dump($retVal['badLine']);
    echo "</br></br>";

?>

