<?php
/* @var $this ChannelController */
/* @var $model Channel */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'channel-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'channel_name'); ?>
		<?php echo $form->textField($model,'channel_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'channel_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'channel_desc'); ?>
		<?php echo $form->textField($model,'channel_desc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'channel_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'channel_icon'); ?>
		<?php echo $form->textField($model,'channel_icon',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'channel_icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'channel_index'); ?>
		<?php echo $form->textField($model,'channel_index'); ?>
		<?php echo $form->error($model,'channel_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role_status_id'); ?>
		<?php echo $form->dropDownList($model, 'role_status_id', RoleStatus::model()->getAllRoleStatusList()); ?>
		<?php echo $form->error($model,'role_status_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->