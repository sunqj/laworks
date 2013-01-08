<?php
/* @var $this DepartmentController */
/* @var $model Department */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'department-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'department_name'); ?>
		<?php echo $form->textField($model,'department_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'department_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department_desc'); ?>
		<?php echo $form->textArea($model,'department_desc', array('cols'=>80,'rows'=>20)); ?>
		<?php echo $form->error($model,'department_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department_status'); ?>
		<?php echo  $form->dropDownList($model, 'department_status', RoleStatus::model()->getAllRoleStatusList()); ?>
		<?php echo $form->error($model,'department_status'); ?>
	</div>

	<div class="row">
	
	    <?php $checkboxList = $form->checkBoxList($model, 'userList',
	            User::model()->getEnterprisePhoneUserList(Yii::app()->user->enterprise_id),
	            array('template'=>'<span class="check">{label}{input}</span>', 'separator'=>' '));
	          $checkboxList = str_replace('<label', '<span', $checkboxList);
	          $checkboxList = str_replace('</label', '</span', $checkboxList);
	          echo $checkboxList; 
	    ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php 
/*
	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>

 */

?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->