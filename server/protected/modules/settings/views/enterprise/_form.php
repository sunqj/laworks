<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enterprise-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_name'); ?>
		<?php echo $form->textField($model,'enterprise_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'enterprise_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_desc'); ?>
		<?php echo $form->textField($model,'enterprise_desc',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'enterprise_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_logo'); ?>
		<?php echo $form->textField($model,'enterprise_logo',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'enterprise_logo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_status'); ?>
		<?php echo $form->textField($model,'enterprise_status'); ?>
		<?php echo $form->error($model,'enterprise_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_audit'); ?>
		<?php echo $form->textField($model,'enterprise_audit'); ?>
		<?php echo $form->error($model,'enterprise_audit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_user_history'); ?>
		<?php echo $form->textField($model,'enterprise_user_history'); ?>
		<?php echo $form->error($model,'enterprise_user_history'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->