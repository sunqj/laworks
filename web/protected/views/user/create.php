<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户'=>array('index'),
	'用户创建',
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h1>用户创建</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
