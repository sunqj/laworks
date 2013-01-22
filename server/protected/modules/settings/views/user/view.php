<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'username',
		'password',
        'user_realname',
        'user_position',
        //'user_status',
        array('label' => 'User Status',
              'value' => $model->roleStatusTable->role_status_name),
        //'permission_id',
        array('label' => 'Permission',
              'value' => $model->permissionTable->permission_name),
		'user_login_count',
		//'user_last_login_time',
		//'user_last_check_time',
        array('label' => 'Last login time',
              'value' => date('Y-m-d H:i:s', $model->user_last_login_time)),
        array('label' => 'Last check time',
              'value' => date('Y-m-d H:i:s', $model->user_last_check_time)),
        'user_other',
        'user_extra',
		'user_email',
        //'user_image',
        //'enterprise_id',
	),
)); ?>
