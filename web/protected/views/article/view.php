<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->article_id,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->article_id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->article_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<h1>View Article #<?php echo $model->article_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'article_id',
		'article_tag',
		'article_url',
		'article_icon',
		'article_type',
		'article_name',
		'article_status',
		'article_content',
		'article_summary',
		'article_isbanner',
		'article_audit_gmt',
		'article_create_gmt',
		'article_update_gmt',
		'article_click_count',
		'article_reject_reason',
		'column_id',
		'audit_user_id',
		'enterprise_id',
		'create_user_id',
	),
)); ?>
