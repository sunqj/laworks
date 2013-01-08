<?php
/* @var $this DepartmentController */
/* @var $data Department */
?>

<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('department_name')); ?>:</b>
	<?php echo CHtml::encode($data->department_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_desc')); ?>:</b>
	<?php echo CHtml::encode($data->department_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_status')); ?>:</b>
	<?php echo CHtml::encode($data->department_status); ?>
	<br />
	
<?php 
/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->department_id), array('view', 'id'=>$data->department_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />
*/
?>

</div>