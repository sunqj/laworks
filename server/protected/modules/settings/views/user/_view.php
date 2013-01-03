<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_cell')); ?>:</b>
	<?php echo CHtml::encode($data->user_cell); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_officetel')); ?>:</b>
	<?php echo CHtml::encode($data->user_officetel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_hometel')); ?>:</b>
	<?php echo CHtml::encode($data->user_hometel); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('permission_id')); ?>:</b>
	<?php echo CHtml::encode($data->permissionTable->permission_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_status')); ?>:</b>
	<?php echo CHtml::encode($data->roleStatusTable->role_status_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_realname')); ?>:</b>
	<?php echo CHtml::encode($data->user_realname); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_position')); ?>:</b>
	<?php echo CHtml::encode($data->user_position); ?>
	<br />

	<?php /*
----------------
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_email')); ?>:</b>
	<?php echo CHtml::encode($data->user_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_image')); ?>:</b>
	<?php echo CHtml::encode($data->user_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_login_count')); ?>:</b>
	<?php echo CHtml::encode($data->user_login_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_last_login_time')); ?>:</b>
	<?php echo CHtml::encode($data->user_last_login_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_last_check_time')); ?>:</b>
	<?php echo CHtml::encode($data->user_last_check_time); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_other')); ?>:</b>
	<?php echo CHtml::encode($data->user_other); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_extra')); ?>:</b>
	<?php echo CHtml::encode($data->user_extra); ?>
	<br />	
----------------
	*/ ?>

</div>