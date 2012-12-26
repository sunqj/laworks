<?php
/* @var $this ColumnController */
/* @var $model Column */

$this->breadcrumbs=array(
	'Columns'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Column', 'url'=>array('index')),
	array('label'=>'Create Column', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('column-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Columns</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'column-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name' => 'column_id', 'htmlOptions' => array('width' => '50')),
        array('name' => 'column_name', 'type' => 'raw',
              'value'=>'CHtml::link($data->column_name,array("column/view", "id"=>$data->column_id), array("target"=>"_blank"))', 
              'htmlOptions' => array('width' => '160')
                ),
		array('name' => 'column_desc', 'htmlOptions' => array('width' => '160')),
		array('name' => 'column_index', 'htmlOptions' => array('width' => '80')),
        array('name' => 'column_status', 'filter'=>RoleStatus::model()->getAllRoleStatusList(),
              'value'=>'$data->roleStatusTable->role_status_name', 
              'htmlOptions' => array('width' => '90')),
        array(
        'class'=>'CButtonColumn',
        'template'=>'{update}{delete}',
        'htmlOptions'=>array('width=30px'),
        'headerHtmlOptions'=>array('width=34px'),
        ),
		/*
		'column_update_gmt',
		'column_icon',
		'enterprise_id',
		'column_create_gmt',
		'column_status',
		array(
			'class'=>'CButtonColumn',
		),
		*/
	),
)); ?>
