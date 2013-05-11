<?php
/* @var $this VoteController */
/* @var $model Vote */

$this->breadcrumbs=array(
	'Votes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Vote', 'url'=>array('index')),
	array('label'=>'Create Vote', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vote-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Votes</h1>

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
	'id'=>'vote-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'vote_id',
		'vote_url',
		'vote_type',
		'vote_name',
		'vote_icon',
		'vote_summary',
		/*
		'vote_content',
		'vote_audit_userid',
		'vote_create_userid',
		'vote_audit_time_gmt',
		'vote_create_time_gmt',
		'vote_status',
		'enterprise_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>