<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */

$this->breadcrumbs=array(
	'Enterprises'=>array('view', 'id' =>$model->enterprise_id)
);


$this->menu=array(
	array('label'=>'Settings', 'url'=>array('update', 'id'=>$model->enterprise_id)),
);
?>

<h1>View Enterprise #<?php echo $model->enterprise_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'enterprise_name',
		'enterprise_desc',
        array('label' => 'Audit status',
              'value' => $model->auditLink->role_status_name),
        array('label' => 'User History',
              'value' => $model->userHistoryLink->role_status_name),
        array(
        'label' => 'Enterprise logo',
        'type' => 'raw',
        'value' => CHtml::image($model->enterprise_logo, 'Enterprise logo', array('style' => 'max-width:100px'))),
	),
)); ?>
