<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_name'); ?>
		<?php echo $form->textField($model,'enterprise_name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<?php
/*


	<div class="row">
		<?php echo $form->label($model,'enterprise_desc'); ?>
		<?php echo $form->textField($model,'enterprise_desc',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_logo'); ?>
		<?php echo $form->textField($model,'enterprise_logo',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_status'); ?>
		<?php echo $form->textField($model,'enterprise_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_audit'); ?>
		<?php echo $form->textField($model,'enterprise_audit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enterprise_user_history'); ?>
		<?php echo $form->textField($model,'enterprise_user_history'); ?>
	</div>
 */ 
    ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->