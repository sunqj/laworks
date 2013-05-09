<?php
/* @var $this VoteController */
/* @var $model Vote */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vote-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_url'); ?>
		<?php echo $form->textField($model,'vote_url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'vote_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_type'); ?>
		<?php echo $form->textField($model,'vote_type'); ?>
		<?php echo $form->error($model,'vote_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_name'); ?>
		<?php echo $form->textField($model,'vote_name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'vote_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_icon'); ?>
		<?php echo $form->textField($model,'vote_icon',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'vote_icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_summary'); ?>
		<?php echo $form->textField($model,'vote_summary',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'vote_summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_content'); ?>
		<?php echo $form->textField($model,'vote_content',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'vote_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_audit_userid'); ?>
		<?php echo $form->textField($model,'vote_audit_userid'); ?>
		<?php echo $form->error($model,'vote_audit_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_create_userid'); ?>
		<?php echo $form->textField($model,'vote_create_userid'); ?>
		<?php echo $form->error($model,'vote_create_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_audit_time_gmt'); ?>
		<?php echo $form->textField($model,'vote_audit_time_gmt'); ?>
		<?php echo $form->error($model,'vote_audit_time_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_create_time_gmt'); ?>
		<?php echo $form->textField($model,'vote_create_time_gmt'); ?>
		<?php echo $form->error($model,'vote_create_time_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_status'); ?>
		<?php echo $form->textField($model,'vote_status'); ?>
		<?php echo $form->error($model,'vote_status'); ?>
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