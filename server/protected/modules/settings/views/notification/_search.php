<?php
/* @var $this NotificationController */
/* @var $model Notification */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'notification_id'); ?>
		<?php echo $form->textField($model,'notification_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_name'); ?>
		<?php echo $form->textField($model,'notification_name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_desc'); ?>
		<?php echo $form->textField($model,'notification_desc',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_audit_gmt'); ?>
		<?php echo $form->textField($model,'notification_audit_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_create_gmt'); ?>
		<?php echo $form->textField($model,'notification_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notification_status'); ?>
		<?php echo $form->textField($model,'notification_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'department_id'); ?>
		<?php echo $form->textField($model,'department_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'audit_user_id'); ?>
		<?php echo $form->textField($model,'audit_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->