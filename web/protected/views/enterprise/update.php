<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */

$this->breadcrumbs=array(
	'Enterprises'=>array('index'),
	$model->enterprise_id=>array('view','id'=>$model->enterprise_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Enterprise', 'url'=>array('index')),
	array('label'=>'Create Enterprise', 'url'=>array('create')),
	array('label'=>'View Enterprise', 'url'=>array('view', 'id'=>$model->enterprise_id)),
	array('label'=>'Manage Enterprise', 'url'=>array('admin')),
);
?>

<h1>Update Enterprise <?php echo $model->enterprise_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>