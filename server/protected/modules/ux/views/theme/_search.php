<?php
/* @var $this ThemeController */
/* @var $model Theme */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'theme_id'); ?>
		<?php echo $form->textField($model,'theme_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_name'); ?>
		<?php echo $form->textField($model,'theme_name',array('size'=>12,'maxlength'=>12)); ?>
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