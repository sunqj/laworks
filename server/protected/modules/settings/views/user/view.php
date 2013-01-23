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
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->username; ?></h1>

<?php 
    $contactsVal = $model->contacts_id == 0 ? '' : 
        "Cell:  " . $model->contactsTable->contacts_cell . "," .
        "Home:  " . $model->contactsTable->contacts_hometel . "," .
        "Office:" . $model->contactsTable->contacts_officetel;

    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'password',
        'user_realname',
        'user_position',
        array('label' => 'User Status',
              'value' => $model->roleStatusTable->role_status_name),
        //'permission_id',
        array('label' => 'Permission',
              'value' => $model->permissionTable->permission_name),
		'user_login_count',
        array('label' => 'Last login time',
              'value' => date('Y-m-d H:i:s', $model->user_last_login_time)),
        array('label' => 'Last check time',
              'value' => date('Y-m-d H:i:s', $model->user_last_check_time)),
        'user_other',
        'user_extra',
		'user_email',
        array('label' => 'Contact', 
               'value' => $contactsVal),
	),
)); ?>
