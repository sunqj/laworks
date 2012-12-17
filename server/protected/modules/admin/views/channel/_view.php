<?php
/* @var $this ChannelController */
/* @var $data Channel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->channel_id), array('view', 'id'=>$data->channel_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_name')); ?>:</b>
	<?php echo CHtml::encode($data->channel_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_desc')); ?>:</b>
	<?php echo CHtml::encode($data->channel_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_icon')); ?>:</b>
	<?php echo CHtml::encode($data->channel_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_index')); ?>:</b>
	<?php echo CHtml::encode($data->channel_index); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->role_status_id); ?>
	<br />


</div>