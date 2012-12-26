<?php
/* @var $this ColumnController */
/* @var $model Column */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'column_id'); ?>
		<?php echo $form->textField($model,'column_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_icon'); ?>
		<?php echo $form->textField($model,'column_icon',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_name'); ?>
		<?php echo $form->textField($model,'column_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_desc'); ?>
		<?php echo $form->textField($model,'column_desc',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_index'); ?>
		<?php echo $form->textField($model,'column_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_create_gmt'); ?>
		<?php echo $form->textField($model,'column_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_update_gmt'); ?>
		<?php echo $form->textField($model,'column_update_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_status'); ?>
		<?php echo $form->textField($model,'column_status'); ?>
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