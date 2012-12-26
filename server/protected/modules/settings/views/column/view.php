<?php
/* @var $this ColumnController */
/* @var $model Column */

$this->breadcrumbs=array(
	'Columns'=>array('index'),
	$model->column_id,
);

$this->menu=array(
	array('label'=>'List Column', 'url'=>array('index')),
	array('label'=>'Create Column', 'url'=>array('create')),
	array('label'=>'Update Column', 'url'=>array('update', 'id'=>$model->column_id)),
	array('label'=>'Delete Column', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->column_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Column', 'url'=>array('admin')),
);
?>

<h1>View Column #<?php echo $model->column_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'column_id',
        array('label' => 'Column name',
              'type' => 'raw',
              'value' => CHtml::link($model->column_name, array(
                       'column/view', 'id' => $model->column_id,
                       ))),
		'column_desc',
		'column_index',
        array('label' => 'Column Create time',
              'value' => date('Y-m-d H:i:s', $model->column_create_gmt),
        ),
        array('label' => 'Column Create time',
                'value' => date('Y-m-d H:i:s', $model->column_update_gmt),
        ),
        array('label' => 'Column Status',
              'value' => $model->roleStatusTable->role_status_name,
        ),
        array('label' => 'Column Icon',
              'type'  => 'raw',
              'value' => CHtml::image($model->column_icon, 'column icon', array('style' => 'max-width:100px')),
        ),
	),
)); ?>
