<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */

$this->breadcrumbs=array(
	'Enterprises'=>array('view', 'id' =>$model->enterprise_id)
);

$this->menu=array(
	array('label'=>'View Enterprise', 'url'=>array('view', 'id'=>$model->enterprise_id)),
);
?>

<h1>Update Enterprise <?php echo $model->enterprise_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>