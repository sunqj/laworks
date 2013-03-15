<?php
/* @var $this ThemeController */
/* @var $model Theme */

$this->breadcrumbs=array(
	'Themes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('theme-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Themes</h1>

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
	'id'=>'theme-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'theme_id',
		'theme_name',
		'theme_c01',
		'theme_c02',
		'theme_c03',
		'theme_c04',
		/*
		'theme_c05',
		'theme_c06',
		'theme_c07',
		'theme_c08',
		'theme_c09',
		'theme_c10',
		'theme_c11',
		'theme_c12',
		'enterprise_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
