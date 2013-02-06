<?php
/* @var $this ThemeController */
/* @var $model Theme */

$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->theme_id=>array('view','id'=>$model->theme_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'View Theme', 'url'=>array('view', 'id'=>$model->theme_id)),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<h1>Update Theme <?php echo $model->theme_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>