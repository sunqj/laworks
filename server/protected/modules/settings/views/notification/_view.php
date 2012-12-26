<?php
/* @var $this NotificationController */
/* @var $data Notification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->notification_id), array('view', 'id'=>$data->notification_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_name')); ?>:</b>
	<?php echo CHtml::encode($data->notification_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_desc')); ?>:</b>
	<?php echo CHtml::encode($data->notification_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_audit_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->notification_audit_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_create_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->notification_create_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_status')); ?>:</b>
	<?php echo CHtml::encode($data->notification_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('audit_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->audit_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	*/ ?>

</div>