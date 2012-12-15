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
		<?php echo $form->labelEx($model,'文章标题'); ?>
		<?php echo $form->textField($model,'article_name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'文章栏目'); ?>
		<?php echo $form->dropDownList($model, 'column_id', Column::model()->getColumnList(1)); ?>
		<?php echo $form->error($model,'column_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'是否作为banner?'); ?>
		<?php echo $form->dropDownList($model, 'article_isbanner', array(0 => '否', 1 => '是')); ?>
		<?php echo $form->error($model,'article_isbanner'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'文章标签'); ?>
		<?php echo $form->textField($model,'article_tag',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'文章图标'); ?>
		<?php echo $form->textField($model,'article_icon',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'article_icon'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'文章摘要'); ?>
		<?php echo $form->textField($model,'article_summary',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'article_summary'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'文章内容'); ?>
		<?php $this->widget('application.extensions.editor.CKkceditor',array(
                "model"=>$model,                # Data-Model
                "attribute"=>'article_content',         # Attribute in the Data-Model
                "height"=>'400px',
                "width"=>'100%',
            	"filespath"=>Yii::app()->basePath."/../upload/",
            	"filesurl"=>Yii::app()->baseUrl."/upload/",
             ));
		 ?>
		<?php echo $form->error($model,'article_content'); ?>
	</div>







	
	
	
	
<!-- useless lines{
    <div class="row">
		<?php echo $form->labelEx($model,'article_type'); ?>
		<?php echo $form->textField($model,'article_type'); ?>
		<?php echo $form->error($model,'article_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'article_status'); ?>
		<?php echo $form->textField($model,'article_status'); ?>
		<?php echo $form->error($model,'article_status'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'article_audit_gmt'); ?>
		<?php echo $form->textField($model,'article_audit_gmt'); ?>
		<?php echo $form->error($model,'article_audit_gmt'); ?>
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
		<?php echo $form->textField($model,'article_reject_reason',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'article_reject_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_url'); ?>
		<?php echo $form->textField($model,'article_url',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'article_url'); ?>
	</div>
	
}useless lines-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '发布' : '修改'); ?>
	</div> 

<?php $this->endWidget(); ?>

</div><!-- form -->