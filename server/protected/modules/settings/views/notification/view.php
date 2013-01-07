<?php
/* @var $this NotificationController */
/* @var $model Notification */

$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->notification_id,
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Create Notification', 'url'=>array('create')),
	//array('label'=>'Update Notification', 'url'=>array('update', 'id'=>$model->notification_id)),
	array('label'=>'Delete Notification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->notification_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notification', 'url'=>array('admin')),
);
?>

<h1>View Notification #<?php echo $model->notification_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'notification_name',
		'notification_desc',
		array('label' => 'Create Time',
		'value' => date('Y-m-d H:i:s', $model->notification_create_gmt)),
		array('label' => 'Notification status',
		'value' => $model->contentStatusTable->content_status_name),
		array('label' => 'Create User',
		'value' => $model->userTable->username,
		),
//'department_id',
//'create_user_id',
//'audit_user_id',
//'enterprise_id',
//'notification_audit_gmt',
// 'notification_id',
// 'notification_url',
	),
)); ?>
