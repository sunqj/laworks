<?php
/* @var $this EnterpriseController */
/* @var $data Enterprise */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_name')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_desc')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_desc); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_appname')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_appname); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_logo')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_audit')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_audit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_user_history')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_user_history); ?>
	<br />

    <?php
    /*
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_status')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_status); ?>
	<br />

    */ 
    ?>

</div>