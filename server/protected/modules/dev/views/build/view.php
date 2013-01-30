<?php
/* @var $this BuildController */
/* @var $model Build */

$this->breadcrumbs=array(
	'Builds'=>array('index'),
	$model->build_id,
);

$this->menu=array(
	array('label'=>'List Build', 'url'=>array('index')),
	array('label'=>'Create Build', 'url'=>array('create')),
	array('label'=>'Update Build', 'url'=>array('update', 'id'=>$model->build_id)),
	array('label'=>'Delete Build', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->build_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Build', 'url'=>array('admin')),
);
?>

<h1>View Build #<?php echo $model->build_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'build_id',
		'build_date',
		'build_version',
		'build_comments',
		'enterprise_id',
	),
)); ?>
