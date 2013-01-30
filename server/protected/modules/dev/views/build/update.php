<?php
/* @var $this BuildController */
/* @var $model Build */

$this->breadcrumbs=array(
	'Builds'=>array('index'),
	$model->build_id=>array('view','id'=>$model->build_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Build', 'url'=>array('index')),
	array('label'=>'Create Build', 'url'=>array('create')),
	array('label'=>'View Build', 'url'=>array('view', 'id'=>$model->build_id)),
	array('label'=>'Manage Build', 'url'=>array('admin')),
);
?>

<h1>Update Build <?php echo $model->build_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>