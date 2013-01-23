<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'password',
        'user_realname',
	    'user_email',
        'user_position',
		'user_login_count',
		'user_last_login_time',
		'user_last_check_time',
		array('label' => 'User Status',
              'value' => $model->roleStatusTable->role_status_name),
		array('label' => 'Permission',
              'value' => $model->permissionTable->permission_name),
		array('label' => 'Enterprise name', 
              'value' => $model->enterpriseTable->enterprise_name),
        /*
        'user_other',
        'user_extra',
        'user_image',
        */
	),
)); ?>
