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

<?php 
	$columnsArray = array(array('label' => 'enterprise_id',
						  'value' => Enterprise::getEnterpriseById($model->enterprise_id)));
	for($i = 1; $i <= 12; ++$i)
	{
		$attrName = $i > 9? "theme_c$i" : "theme_c0$i";
		array_push($columnsArray, array('label' => $attrName, 
				   'value' => Column::getColumnNameById($model[$attrName]))
		);
	}
	
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array_merge(array('theme_id',	'theme_name'),$columnsArray))); 
?>
