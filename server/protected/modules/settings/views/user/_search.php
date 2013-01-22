<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_other'); ?>
		<?php echo $form->textField($model,'user_other',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_extra'); ?>
		<?php echo $form->textField($model,'user_extra',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_image'); ?>
		<?php echo $form->textField($model,'user_image',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_email'); ?>
		<?php echo $form->textField($model,'user_email',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_realname'); ?>
		<?php echo $form->textField($model,'user_realname',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_position'); ?>
		<?php echo $form->textField($model,'user_position'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_login_count'); ?>
		<?php echo $form->textField($model,'user_login_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_last_login_time'); ?>
		<?php echo $form->textField($model,'user_last_login_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_last_check_time'); ?>
		<?php echo $form->textField($model,'user_last_check_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_status'); ?>
		<?php echo $form->textField($model,'user_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permission_id'); ?>
		<?php echo $form->textField($model,'permission_id'); ?>
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