<?php
/* @var $this SettingController */
/* @var $model Setting */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'setting_id'); ?>
		<?php echo $form->textField($model,'setting_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'setting_audit'); ?>
		<?php echo $form->textField($model,'setting_audit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'setting_user_history'); ?>
		<?php echo $form->textField($model,'setting_user_history'); ?>
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