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
	array('label'=>'Delete Build', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->build_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Build', 'url'=>array('admin')),
);
?>

<h1>View Build #<?php echo $model->build_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array('label' => 'build_version',
              'type'  => 'raw',
              'value' => CHtml::link($model->build_version, array("build/view", "id"=>$model->build_id))),  
        'build_comments',
		array('label' => 'build_date',
              'value' => date("Y-m-d, h:i:s", $model->build_date)),
		array('label' => 'enterprise_id', 
              'value' => $model->enterpriseTable->enterprise_name),
        array('label' => 'build_version',
              'type'  => 'raw',
              'value' => CHtml::link($model->build_version, 
                    Yii::app()->getBaseUrl() . "/apk/$model->enterprise_id/$model->build_version.apk"), 
                )
	),


)); ?>
