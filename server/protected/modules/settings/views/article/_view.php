<?php
/* @var $this ArticleController */
/* @var $data Article */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->article_id), array('view', 'id'=>$data->article_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_name')); ?>:</b>
	<?php echo CHtml::encode($data->article_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_summary')); ?>:</b>
	<?php echo CHtml::encode($data->article_summary); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('column_id')); ?>:</b>
	<?php echo CHtml::encode($data->column_id); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->userTable->username); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('article_type')); ?>:</b>
	<?php echo CHtml::encode($data->contentTypeTable->content_type_name); ?>
	<br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('article_status')); ?>:</b>
	<?php echo CHtml::encode($data->contentStatusTable->content_status_name); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('article_isbanner')); ?>:</b>
	<?php echo CHtml::encode($data->getBannerValue($data->article_isbanner)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_create_gmt')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s', $data->article_create_gmt)); ?>
	<br />

	<?php /*
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('article_icon')); ?>:</b>
	<?php echo CHtml::encode($data->article_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_url')); ?>:</b>
	<?php echo CHtml::encode($data->article_url); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('audit_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->audit_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_audit_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->article_audit_gmt); ?>
	<br />    
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('article_update_gmt')); ?>:</b>
	<?php echo CHtml::encode($data->article_update_gmt); ?>
	<br />    
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('article_tag')); ?>:</b>
	<?php echo CHtml::encode($data->article_tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_content')); ?>:</b>
	<?php echo CHtml::encode($data->article_content); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('article_click_count')); ?>:</b>
	<?php echo CHtml::encode($data->article_click_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_reject_reason')); ?>:</b>
	<?php echo CHtml::encode($data->article_reject_reason); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('enterprise_id')); ?>:</b>
	<?php echo CHtml::encode($data->enterprise_id); ?>
	<br />



	*/ ?>

</div>