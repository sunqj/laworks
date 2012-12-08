<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'用户创建', 'url'=>array('create')),
	array('label'=>'用户修改', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'用户删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'确定删除？')),
	array('label'=>'用户管理', 'url'=>array('admin')),
);
?>

<h1>用户查看#<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'username',
		'password',
		'user_cell',
		'user_other',
		'user_extra',
		'user_image',
		'user_email',
		'user_status',
		'user_hometel',
		'user_realname',
		'user_position',
		'user_officetel',
		'user_login_count',
		'user_last_login_time',
		'user_last_check_time',
		'permission_id',
		'enterprise_id',
	),
)); ?>
