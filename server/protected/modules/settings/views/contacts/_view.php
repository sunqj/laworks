<?php
/* @var $this ContactsController */
/* @var $data Contacts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacts_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contacts_name), array('view', 'id'=>$data->contacts_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacts_cell')); ?>:</b>
	<?php echo CHtml::encode($data->contacts_cell); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacts_hometel')); ?>:</b>
	<?php echo CHtml::encode($data->contacts_hometel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacts_officetel')); ?>:</b>
	<?php echo CHtml::encode($data->contacts_officetel); ?>
	<br />

</div>