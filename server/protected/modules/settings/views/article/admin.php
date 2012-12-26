<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Articles</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'article-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'article_id',
		'article_tag',
		'article_url',
		'article_icon',
		'article_type',
		'article_name',
		/*
		'article_content',
		'article_summary',
		'article_isbanner',
		'article_audit_gmt',
		'article_create_gmt',
		'article_update_gmt',
		'article_click_count',
		'article_reject_reason',
		'article_status',
		'column_id',
		'audit_user_id',
		'enterprise_id',
		'create_user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
