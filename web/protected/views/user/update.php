<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'用户修改',
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'用户创建', 'url'=>array('create')),
	array('label'=>'用户查看', 'url'=>array('view', 'id'=>$model->user_id)),
        array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h1>用户修改<?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
