<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'article_name'); ?>
		<?php echo $form->textField($model,'article_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'article_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_summary'); ?>
		<?php echo $form->textField($model,'article_summary',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'article_summary'); ?>
	</div>
	
    <div class="row">
		<?php echo $form->labelEx($model,'column_id'); ?>
		<?php echo $form->dropDownList($model, 'column_id', Column::model()->getEnterpriseColumnList(Yii::app()->user->enterprise_id)); ?>
		<?php echo $form->error($model,'column_id'); ?>
	</div>
	
    <div class="row">
		<?php echo $form->labelEx($model,'article_isbanner'); ?>
		<?php echo $form->dropDownList($model, 'article_isbanner', $model->getBannerList()); ?>
		<?php echo $form->error($model,'article_isbanner'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'article_type'); ?>
		<?php echo $form->dropDownList($model, 'article_type', ContentType::model()->getAllContentTypeList()); ?>
		<?php echo $form->error($model,'article_type'); ?>
	</div>
	

	
	<div class="row">
	    <?php

	    ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'article_content'); ?>
		<?php //need fix: if enterprise upload directory does not exist, update would be unavailable. ?>
		<?php 
		        require Yii::app ()->getBasePath () . '/utils/DirUtils.php';
		        $this->widget('application.extensions.editor.CKkceditor',array(
                "model"=>$model,                # Data-Model
                "attribute"=>'article_content',         # Attribute in the Data-Model
                "height"=>'400px',
                "width"=>'100%',
            	"filespath"=>getArticleIconDirAbsolute(),
            	"filesurl"=>getArticleIconDirRelative(),
                //"filespath"=>Yii::app()->basePath."/../upload/".Yii::app()->user->enterprise_id . "/",
                //"filesurl"=>Yii::app()->baseUrl."/upload/".Yii::app()->user->enterprise_id . "/",
             ));
		 ?>
		<?php echo $form->error($model,'article_content'); ?>
	</div>
	
	
	<div class="row">
	    <?php echo $form->labelEx($model,'article_icon'); ?>
		<?php $this->widget('application.extensions.MUploadify.MUploadify',array(
		        'model'=>$model,
		        'attribute'=>'article_icon',
		        'auto'=>true,
		        'script'=>array('article/upload','id'=>$model->article_id),
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
							//alert(rArray[1]);
		                    var imgChild = "<img src="+rArray[1]+ " style=\"max-width:100px\" />";
		                    $("#img_prev").append(imgChild);
		                    $("#ytArticle_article_icon").val(rArray[1]);
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
	 * 
	<div class="row">
		<?php echo $form->labelEx($model,'audit_user_id'); ?>
		<?php echo $form->textField($model,'audit_user_id'); ?>
		<?php echo $form->error($model,'audit_user_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'article_status'); ?>
		<?php echo $form->textField($model,'article_status'); ?>
		<?php echo $form->error($model,'article_status'); ?>
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
	
	<div class="row">
		<?php echo $form->labelEx($model,'article_tag'); ?>
		<?php echo $form->textField($model,'article_tag',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_tag'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'article_url'); ?>
		<?php echo $form->textField($model,'article_url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_icon'); ?>
		<?php echo $form->textField($model,'article_icon',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_create_gmt'); ?>
		<?php echo $form->textField($model,'article_create_gmt'); ?>
		<?php echo $form->error($model,'article_create_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_update_gmt'); ?>
		<?php echo $form->textField($model,'article_update_gmt'); ?>
		<?php echo $form->error($model,'article_update_gmt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_click_count'); ?>
		<?php echo $form->textField($model,'article_click_count'); ?>
		<?php echo $form->error($model,'article_click_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_reject_reason'); ?>
		<?php echo $form->textField($model,'article_reject_reason',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_reject_reason'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'article_audit_gmt'); ?>
		<?php echo $form->textField($model,'article_audit_gmt'); ?>
		<?php echo $form->error($model,'article_audit_gmt'); ?>
	</div>
	 */ 
	?>
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->
