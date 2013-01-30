<?php
/* @var $this BuildController */
/* @var $model Build */

$this->breadcrumbs=array(
	'Builds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Build', 'url'=>array('index')),
	array('label'=>'Manage Build', 'url'=>array('admin')),
);
?>

<h1>Create Build</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'branchList' => $branchList)); ?>