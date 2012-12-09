<?php
/* @var $this SettingController */
/* @var $data Setting */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->setting_id), array('view', 'id'=>$data->setting_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting_audit')); ?>:</b>
	<?php echo CHtml::encode($data->setting_audit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('setting_user_history')); ?>:</b>
	<?php echo CHtml::encode($data->setting_user_history); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />


</div>