<?php
/* @var $this ContactsController */
/* @var $model Contacts */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'contacts_id'); ?>
		<?php echo $form->textField($model,'contacts_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacts_name'); ?>
		<?php echo $form->textField($model,'contacts_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacts_cell'); ?>
		<?php echo $form->textField($model,'contacts_cell',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacts_hometel'); ?>
		<?php echo $form->textField($model,'contacts_hometel',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacts_officetel'); ?>
		<?php echo $form->textField($model,'contacts_officetel',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->