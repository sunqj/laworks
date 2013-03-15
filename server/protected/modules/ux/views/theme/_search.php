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
		<?php echo $form->label($model,'theme_c01'); ?>
		<?php echo $form->textField($model,'theme_c01'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c02'); ?>
		<?php echo $form->textField($model,'theme_c02'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c03'); ?>
		<?php echo $form->textField($model,'theme_c03'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c04'); ?>
		<?php echo $form->textField($model,'theme_c04'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c05'); ?>
		<?php echo $form->textField($model,'theme_c05'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c06'); ?>
		<?php echo $form->textField($model,'theme_c06'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c07'); ?>
		<?php echo $form->textField($model,'theme_c07'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c08'); ?>
		<?php echo $form->textField($model,'theme_c08'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c09'); ?>
		<?php echo $form->textField($model,'theme_c09'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c10'); ?>
		<?php echo $form->textField($model,'theme_c10'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c11'); ?>
		<?php echo $form->textField($model,'theme_c11'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theme_c12'); ?>
		<?php echo $form->textField($model,'theme_c12'); ?>
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