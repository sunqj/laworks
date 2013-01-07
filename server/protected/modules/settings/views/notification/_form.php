<?php
/* @var $this NotificationController */
/* @var $model Notification */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_name'); ?>
		<?php echo $form->textField($model,'notification_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'notification_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_desc'); ?>
		<?php //need fix: if enterprise upload directory does not exist, update would be unavailable. ?>
		<?php 
		        require Yii::app ()->getBasePath() . '/utils/utils.php';
		        $this->widget('application.extensions.editor.CKkceditor',array(
                "model"=>$model,                # Data-Model
                "attribute"=>'notification_desc',         # Attribute in the Data-Model
                "height"=>'400px',
                "width"=>'100%',
            	"filespath"=>getArticleIconDirAbsolute(),
            	"filesurl"=>getArticleIconDirRelative(),
             ));
		 ?>
		<?php echo $form->error($model,'article_content'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'department_id'); ?>
		<?php echo $form->textField($model,'department_id'); ?>
		<?php echo $form->error($model,'department_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php 
/*

	<div class="row">
		<?php echo $form->labelEx($model,'notification_status'); ?>
		<?php echo $form->textField($model,'notification_status'); ?>
		<?php echo $form->error($model,'notification_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_audit_gmt'); ?>
		<?php echo $form->textField($model,'notification_audit_gmt'); ?>
		<?php echo $form->error($model,'notification_audit_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_create_gmt'); ?>
		<?php echo $form->textField($model,'notification_create_gmt'); ?>
		<?php echo $form->error($model,'notification_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_url'); ?>
		<?php echo $form->textField($model,'notification_url',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'notification_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'audit_user_id'); ?>
		<?php echo $form->textField($model,'audit_user_id'); ?>
		<?php echo $form->error($model,'audit_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>


 */

?>	
	
<?php $this->endWidget(); ?>

</div><!-- form -->