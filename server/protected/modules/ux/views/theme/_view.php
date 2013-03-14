<?php
/* @var $this ThemeController */
/* @var $data Theme */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->theme_id), array('view', 'id'=>$data->theme_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_name')); ?>:</b>
	<?php echo CHtml::encode($data->theme_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_o1')); ?>:</b>
	<?php echo CHtml::encode($data->theme_o1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_o2')); ?>:</b>
	<?php echo CHtml::encode($data->theme_o2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_o3')); ?>:</b>
	<?php echo CHtml::encode($data->theme_o3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_o4')); ?>:</b>
	<?php echo CHtml::encode($data->theme_o4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_o5')); ?>:</b>
	<?php echo CHtml::encode($data->theme_o5); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />

	*/ ?>

</div>