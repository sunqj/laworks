<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */

$this->breadcrumbs=array(
	'Enterprises'=>array('index'),
	$model->enterprise_id,
);

$this->menu=array(
	array('label'=>'List Enterprise', 'url'=>array('index')),
	array('label'=>'Create Enterprise', 'url'=>array('create')),
	array('label'=>'Update Enterprise', 'url'=>array('update', 'id'=>$model->enterprise_id)),
	array('label'=>'Delete Enterprise', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->enterprise_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Enterprise', 'url'=>array('admin')),
);
?>

<h1>View Enterprise #<?php echo $model->enterprise_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'enterprise_id',
		'enterprise_name',
		'enterprise_desc',
		'enterprise_logo',
		'enterprise_status',
	),
)); ?>
