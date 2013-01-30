<?php
/* @var $this BuildController */
/* @var $model Build */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'build_id'); ?>
		<?php echo $form->textField($model,'build_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'build_date'); ?>
		<?php echo $form->textField($model,'build_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'build_version'); ?>
		<?php echo $form->textField($model,'build_version',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'build_comments'); ?>
		<?php echo $form->textField($model,'build_comments',array('size'=>60,'maxlength'=>60)); ?>
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