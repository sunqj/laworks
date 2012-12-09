<?php
/* @var $this ChannelController */
/* @var $model Channel */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'channel_id'); ?>
		<?php echo $form->textField($model,'channel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_name'); ?>
		<?php echo $form->textField($model,'channel_name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_desc'); ?>
		<?php echo $form->textField($model,'channel_desc',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_icon'); ?>
		<?php echo $form->textField($model,'channel_icon',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_index'); ?>
		<?php echo $form->textField($model,'channel_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_status'); ?>
		<?php echo $form->textField($model,'channel_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->