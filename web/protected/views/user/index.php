<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'用户',
);

$this->menu=array(
	array('label'=>'用户创建', 'url'=>array('create')),
	array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h1>用户</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
