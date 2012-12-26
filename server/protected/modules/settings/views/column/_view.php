<?php
/* @var $this ColumnController */
/* @var $data Column */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->column_id), array('view', 'id'=>$data->column_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_name')); ?>:</b>
	<?php echo CHtml::encode($data->column_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_desc')); ?>:</b>
	<?php echo CHtml::encode($data->column_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_index')); ?>:</b>
	<?php echo CHtml::encode($data->column_index); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_status')); ?>:</b>
	<?php echo CHtml::encode($data->roleStatusTable->role_status_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('column_create_gmt')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s', $data->column_update_gmt)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('column_update_gmt')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s', $data->column_update_gmt)); ?>
	<br />
	
	<?php 
	/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('column_icon')); ?>:</b>
	<?php echo CHtml::encode($data->column_icon); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />
	*/
	?>

</div>