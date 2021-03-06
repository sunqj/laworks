<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage News</h1>

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
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'news_id',
		'news_name',
 		array('name'=>'news_type', 'filter'=>ContentType::model()->getAllContentTypeList(), 
                 'value'=>'$data->contentTypeTable->content_type_name'),

		/*
		'news_url',
		'news_content',
		'news_summary',
	    'news_icon',
		'news_audit_gmt',
		'news_create_gmt',
		'news_update_gmt',
		'news_click_count',
		'news_status',
		'channel_id',
		'audit_user_id',
		'create_user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
