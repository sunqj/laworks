<?php
/* @var $this ColumnController */
/* @var $model Column */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'column-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'column_name'); ?>
		<?php echo $form->textField($model,'column_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'column_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_desc'); ?>
		<?php echo $form->textField($model,'column_desc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'column_desc'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'column_index'); ?>
		<?php echo $form->textField($model,'column_index'); ?>
		<?php echo $form->error($model,'column_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_status'); ?>
		<?php echo $form->dropDownList($model, 'column_status', RoleStatus::model()->getAllRoleStatusList()); ?>
		<?php echo $form->error($model,'column_status'); ?>
	</div>

	<div class="row">
	    <?php echo $form->labelEx($model,'column_icon'); ?>
		<?php $this->widget('application.extensions.MUploadify.MUploadify',array(
		        'model'=>$model,
		        'attribute'=>'column_icon',
		        'auto'=>true,
		        'script'=>array('column/upload','id'=>$model->column_id),
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
		                    $("#ytColumn_column_icon").val(rArray[1]);
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
		<?php echo $form->labelEx($model,'column_create_gmt'); ?>
		<?php echo $form->textField($model,'column_create_gmt'); ?>
		<?php echo $form->error($model,'column_create_gmt'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->textField($model,'enterprise_id'); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'column_update_gmt'); ?>
		<?php echo $form->textField($model,'column_update_gmt'); ?>
		<?php echo $form->error($model,'column_update_gmt'); ?>
	</div>
	 */ 
	?>
	
<?php $this->endWidget(); ?>

</div><!-- form -->