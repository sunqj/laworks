<?php
/* @var $this EnterpriseController */
/* @var $model Enterprise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enterprise-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_name'); ?>
		<?php echo $form->textField($model,'enterprise_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'enterprise_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_desc'); ?>
		<?php echo $form->textField($model,'enterprise_desc',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'enterprise_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_audit'); ?>
		<?php echo $form->dropDownList($model, 'enterprise_audit', RoleStatus::model()->getAllRoleStatusList()); ?>
		<?php echo $form->error($model,'enterprise_audit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_user_history'); ?>
		<?php echo $form->dropDownList($model, 'enterprise_user_history', RoleStatus::model()->getAllRoleStatusList()); ?>
		<?php echo $form->error($model,'enterprise_user_history'); ?>
	</div>

	<div class="row">
	    <?php echo $form->labelEx($model,'enterprise_logo'); ?>
		<?php $this->widget('application.extensions.MUploadify.MUploadify',array(
		        'model'=>$model,
		        'attribute'=>'enterprise_logo',
		        'auto'=>true,
		        'script'=>array('enterprise/upload','id'=>$model->enterprise_id),
		        'onComplete'=>'js:function(event, queueID, fileObj, response, data)
		            {
		                while(img_prev.firstChild)
		                {
		                    var oldNode = img_prev.removeChild(img_prev.firstChild);
		                    oldNode = null;
		                }
		                rArray = response.split(":");

		                if(rArray[0] == 0)
		                {
		                    var imgChild = "<img src="+rArray[1]+ " style=\"max-width:100px\" />";
		                    $("#img_prev").append(imgChild);
		                    $("#ytEnterprise_enterprise_logo").val(rArray[1]);
		                }
		                else
		                {
		                    alert(rArray[1]);
		                }
                    }',            
            ));
		?>
	</div>

	<div id="img_prev" name="img_prev">    </div>
	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	
	
	
<?php
/*
	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_status'); ?>
		<?php echo $form->textField($model,'enterprise_status'); ?>
		<?php echo $form->error($model,'enterprise_status'); ?>
	</div>
 */ 
?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->