<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'news_id'); ?>
		<?php echo $form->textField($model,'news_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_url'); ?>
		<?php echo $form->textField($model,'news_url',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_name'); ?>
		<?php echo $form->textField($model,'news_name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_icon'); ?>
		<?php echo $form->textField($model,'news_icon',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_type'); ?>
		<?php echo $form->textField($model,'news_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_content'); ?>
		<?php echo $form->textField($model,'news_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_summary'); ?>
		<?php echo $form->textField($model,'news_summary',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_audit_gmt'); ?>
		<?php echo $form->textField($model,'news_audit_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_create_gmt'); ?>
		<?php echo $form->textField($model,'news_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_update_gmt'); ?>
		<?php echo $form->textField($model,'news_update_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_click_count'); ?>
		<?php echo $form->textField($model,'news_click_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news_status'); ?>
		<?php echo $form->textField($model,'news_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'channel_id'); ?>
		<?php echo $form->textField($model,'channel_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'audit_user_id'); ?>
		<?php echo $form->textField($model,'audit_user_id'); ?>
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