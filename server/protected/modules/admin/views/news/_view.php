<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->news_id), array('view', 'id'=>$data->news_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_url')); ?>:</b>
	<?php echo CHtml::encode($data->news_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_name')); ?>:</b>
	<?php echo CHtml::encode($data->news_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_icon')); ?>:</b>
	<?php echo CHtml::encode($data->news_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_type')); ?>:</b>
	<?php echo CHtml::encode($data->news_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_content')); ?>:</b>
	<?php echo CHtml::encode($data->news_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_summary')); ?>:</b>
	<?php echo CHtml::encode($data->news_summary); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('news_audit_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->news_audit_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_create_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->news_create_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_update_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->news_update_gmt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_click_count')); ?>:</b>
	<?php echo CHtml::encode($data->news_click_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news_status')); ?>:</b>
	<?php echo CHtml::encode($data->news_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_id')); ?>:</b>
	<?php echo CHtml::encode($data->channel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('audit_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->audit_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	*/ ?>

</div>