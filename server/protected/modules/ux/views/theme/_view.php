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

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />


</div>