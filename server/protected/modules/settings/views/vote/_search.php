<?php
/* @var $this VoteController */
/* @var $model Vote */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'vote_id'); ?>
		<?php echo $form->textField($model,'vote_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_url'); ?>
		<?php echo $form->textField($model,'vote_url',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_type'); ?>
		<?php echo $form->textField($model,'vote_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_name'); ?>
		<?php echo $form->textField($model,'vote_name',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_icon'); ?>
		<?php echo $form->textField($model,'vote_icon',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_summary'); ?>
		<?php echo $form->textField($model,'vote_summary',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_content'); ?>
		<?php echo $form->textField($model,'vote_content',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_audit_userid'); ?>
		<?php echo $form->textField($model,'vote_audit_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_create_userid'); ?>
		<?php echo $form->textField($model,'vote_create_userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_audit_time_gmt'); ?>
		<?php echo $form->textField($model,'vote_audit_time_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_create_time_gmt'); ?>
		<?php echo $form->textField($model,'vote_create_time_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vote_status'); ?>
		<?php echo $form->textField($model,'vote_status'); ?>
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