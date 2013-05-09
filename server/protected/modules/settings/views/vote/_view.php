<?php
/* @var $this VoteController */
/* @var $data Vote */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->vote_id), array('view', 'id'=>$data->vote_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_url')); ?>:</b>
	<?php echo CHtml::encode($data->vote_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_type')); ?>:</b>
	<?php echo CHtml::encode($data->vote_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_name')); ?>:</b>
	<?php echo CHtml::encode($data->vote_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_icon')); ?>:</b>
	<?php echo CHtml::encode($data->vote_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_summary')); ?>:</b>
	<?php echo CHtml::encode($data->vote_summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_content')); ?>:</b>
	<?php echo CHtml::encode($data->vote_content); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_audit_userid')); ?>:</b>
	<?php echo CHtml::encode($data->vote_audit_userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_create_userid')); ?>:</b>
	<?php echo CHtml::encode($data->vote_create_userid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_audit_time_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->vote_audit_time_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_create_time_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->vote_create_time_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vote_status')); ?>:</b>
	<?php echo CHtml::encode($data->vote_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />

	*/ ?>

</div>