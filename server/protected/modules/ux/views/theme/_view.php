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

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c01')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c01); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c02')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c02); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c03')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c03); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c04')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c04); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c05')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c05); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c06')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c06); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c07')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c07); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c08')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c08); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c09')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c09); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c10')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c10); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c11')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c11); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theme_c12')); ?>:</b>
	<?php echo CHtml::encode($data->theme_c12); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />

	*/ ?>

</div>