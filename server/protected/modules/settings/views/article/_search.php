<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'article_id'); ?>
		<?php echo $form->textField($model,'article_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_tag'); ?>
		<?php echo $form->textField($model,'article_tag',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_url'); ?>
		<?php echo $form->textField($model,'article_url',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_icon'); ?>
		<?php echo $form->textField($model,'article_icon',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_type'); ?>
		<?php echo $form->textField($model,'article_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_name'); ?>
		<?php echo $form->textField($model,'article_name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_content'); ?>
		<?php echo $form->textField($model,'article_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_summary'); ?>
		<?php echo $form->textField($model,'article_summary',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_isbanner'); ?>
		<?php echo $form->textField($model,'article_isbanner'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_audit_gmt'); ?>
		<?php echo $form->textField($model,'article_audit_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_create_gmt'); ?>
		<?php echo $form->textField($model,'article_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_update_gmt'); ?>
		<?php echo $form->textField($model,'article_update_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_click_count'); ?>
		<?php echo $form->textField($model,'article_click_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_reject_reason'); ?>
		<?php echo $form->textField($model,'article_reject_reason',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_status'); ?>
		<?php echo $form->textField($model,'article_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'column_id'); ?>
		<?php echo $form->textField($model,'column_id'); ?>
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