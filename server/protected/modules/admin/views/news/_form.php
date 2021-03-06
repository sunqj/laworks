<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'news_name'); ?>
		<?php echo $form->textField($model,'news_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'news_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_summary'); ?>
		<?php echo $form->textField($model,'news_summary',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'news_summary'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'channel_id'); ?>
		<?php echo $form->dropDownList($model, 'channel_id', Channel::model()->getAvailableChannelList()); ?>
		<?php echo $form->error($model,'channel_id'); ?>
	</div>
		
	<div class="row">
	    <?php echo $form->labelEx($model,'news_icon'); ?>
		<?php $this->widget('application.extensions.MUploadify.MUploadify',array(
		        'model'=>$model,
		        'attribute'=>'news_icon',
		        'auto'=>true,
		        'script'=>array('news/upload','id'=>$model->news_id),
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
		                    $("#ytNews_news_icon").val(rArray[1]);
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

	<div class="row">
		<?php echo $form->labelEx($model,'news_content'); ?>
		<?php //need fix: if enterprise upload directory does not exist, update would be unavailable. ?>
		<?php $this->widget('application.extensions.editor.CKkceditor',array(
                "model"=>$model,                # Data-Model
                "attribute"=>'news_content',         # Attribute in the Data-Model
                "height"=>'400px',
                "width"=>'100%',
            	"filespath"=>Yii::app()->basePath."/../upload/".Yii::app()->user->enterprise_id . "/",
            	"filesurl"=>Yii::app()->baseUrl."/upload/".Yii::app()->user->enterprise_id . "/",
             ));
		 ?>
		<?php echo $form->error($model,'news_content'); ?>
	</div>




<?php
/*
 	<div class="row">
		<?php echo $form->labelEx($model,'audit_user_id'); ?>
		<?php echo $form->textField($model,'audit_user_id'); ?>
		<?php echo $form->error($model,'audit_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
		<?php echo $form->error($model,'create_user_id'); ?>
	</div>
 
 	<div class="row">
		<?php echo $form->labelEx($model,'news_url'); ?>
		<?php echo $form->textField($model,'news_url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'news_url'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'news_type'); ?>
		<?php echo $form->textField($model,'news_type'); ?>
		<?php echo $form->error($model,'news_type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'news_audit_gmt'); ?>
		<?php echo $form->textField($model,'news_audit_gmt'); ?>
		<?php echo $form->error($model,'news_audit_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_create_gmt'); ?>
		<?php echo $form->textField($model,'news_create_gmt'); ?>
		<?php echo $form->error($model,'news_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_update_gmt'); ?>
		<?php echo $form->textField($model,'news_update_gmt'); ?>
		<?php echo $form->error($model,'news_update_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_click_count'); ?>
		<?php echo $form->textField($model,'news_click_count'); ?>
		<?php echo $form->error($model,'news_click_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news_status'); ?>
		<?php echo $form->textField($model,'news_status'); ?>
		<?php echo $form->error($model,'news_status'); ?>
	</div>

 */ 
?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->