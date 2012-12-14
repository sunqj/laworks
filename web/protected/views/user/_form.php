<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_cell'); ?>
		<?php echo $form->textField($model,'user_cell',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'user_cell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_other'); ?>
		<?php echo $form->textField($model,'user_other',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'user_other'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_extra'); ?>
		<?php echo $form->textField($model,'user_extra',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'user_extra'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_image'); ?>
		<?php echo $form->textField($model,'user_image',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'user_image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_status'); ?>
		<?php echo $form->textField($model,'user_status'); ?>
		<?php echo $form->error($model,'user_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_hometel'); ?>
		<?php echo $form->textField($model,'user_hometel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'user_hometel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_realname'); ?>
		<?php echo $form->textField($model,'user_realname',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'user_realname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_position'); ?>
		<?php echo $form->textField($model,'user_position'); ?>
		<?php echo $form->error($model,'user_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_officetel'); ?>
		<?php echo $form->textField($model,'user_officetel',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'user_officetel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_login_count'); ?>
		<?php echo $form->textField($model,'user_login_count'); ?>
		<?php echo $form->error($model,'user_login_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_last_login_time'); ?>
		<?php echo $form->textField($model,'user_last_login_time'); ?>
		<?php echo $form->error($model,'user_last_login_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_last_check_time'); ?>
		<?php echo $form->textField($model,'user_last_check_time'); ?>
		<?php echo $form->error($model,'user_last_check_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'permission_id'); ?>
		<?php echo $form->dropDownList($model, 'permission_id', Permission::model()->getPermissionType()); ?>
		<?php echo $form->error($model,'permission_id'); ?>
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