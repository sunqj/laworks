<?php
/* @var $this ThemeController */
/* @var $model Theme */

$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->theme_id,
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'Update Theme', 'url'=>array('update', 'id'=>$model->theme_id)),
	array('label'=>'Delete Theme', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->theme_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1>View Theme #<?php echo $model->theme_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'theme_id',
		'theme_name',
		'theme_c01',
		'theme_c02',
		'theme_c03',
		'theme_c04',
		'theme_c05',
		'theme_c06',
		'theme_c07',
		'theme_c08',
		'theme_c09',
		'theme_c10',
		'theme_c11',
		'theme_c12',
		'enterprise_id',
	),
)); ?>
