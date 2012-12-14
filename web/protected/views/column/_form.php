<?php
/* @var $this ColumnController */
/* @var $model Column */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'column-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'column_id'); ?>
		<?php echo $form->textField($model,'column_id'); ?>
		<?php echo $form->error($model,'column_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_icon'); ?>
		<?php echo $form->textField($model,'column_icon',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'column_icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_name'); ?>
		<?php echo $form->textField($model,'column_name',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'column_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_desc'); ?>
		<?php echo $form->textField($model,'column_desc',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'column_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_index'); ?>
		<?php echo $form->textField($model,'column_index'); ?>
		<?php echo $form->error($model,'column_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_status'); ?>
		<?php echo $form->textField($model,'column_status'); ?>
		<?php echo $form->error($model,'column_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_create_gmt'); ?>
		<?php echo $form->textField($model,'column_create_gmt'); ?>
		<?php echo $form->error($model,'column_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_update_gmt'); ?>
		<?php echo $form->textField($model,'column_update_gmt'); ?>
		<?php echo $form->error($model,'column_update_gmt'); ?>
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