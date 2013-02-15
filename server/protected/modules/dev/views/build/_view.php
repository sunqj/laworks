<?php
/* @var $this BuildController */
/* @var $data Build */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('build_version')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->build_version), array('view', 'id'=>$data->build_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('build_date')); ?>:</b>
	<?php echo CHtml::encode(date("Y-m-d", $data->build_date)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('build_comments')); ?>:</b>
	<?php echo CHtml::encode($data->build_comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterpriseTable->enterprise_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('build_type')); ?>:</b>
	<?php echo CHtml::encode($data->getBuildTypeName($data->build_type)); ?>
	<br />

</div>