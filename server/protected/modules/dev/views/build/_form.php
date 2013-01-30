<?php
/* @var $this BuildController */
/* @var $model Build */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'build-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'build_date'); ?>
		<?php echo $form->textField($model,'build_date'); ?>
		<?php echo $form->error($model,'build_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'build_version'); ?>
		<?php echo $form->textField($model,'build_version',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'build_version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'build_comments'); ?>
		<?php echo $form->textField($model,'build_comments',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'build_comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->