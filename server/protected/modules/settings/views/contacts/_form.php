<?php
/* @var $this ContactsController */
/* @var $model Contacts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contacts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'contacts_name'); ?>
		<?php echo $form->textField($model,'contacts_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'contacts_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contacts_cell'); ?>
		<?php echo $form->textField($model,'contacts_cell',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'contacts_cell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contacts_hometel'); ?>
		<?php echo $form->textField($model,'contacts_hometel',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'contacts_hometel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contacts_officetel'); ?>
		<?php echo $form->textField($model,'contacts_officetel',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'contacts_officetel'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'contacts_title'); ?>
		<?php echo $form->textField($model,'contacts_title',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'contacts_title'); ?>
	</div>
	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->