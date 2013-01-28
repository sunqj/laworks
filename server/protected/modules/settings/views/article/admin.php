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
        array('name'  => 'article_name',
               'type' => 'raw',
               'value'=>'CHtml::link($data->article_name,array("article/view", "id"=>$data->article_id))', 
               'htmlOptions'=>array('width'=>'240px')),
	        
        array('name'  => 'article_type',
              'filter'=> ContentType::model()->getAllContentTypeList(),
              'value' => '$data->contentTypeTable->content_type_name',
              'htmlOptions' => array('width'=>'60px')),
	        
        array('name'=>'column_id',
              'filter'=> Column::model()->getEnterpriseColumnList(Yii::app()->user->enterprise_id),
              'value' => '$data->columnTable->column_name',
              'htmlOptions'=>array('width'=>'60px')),
	        
        array('name'=>'article_isbanner',
              'filter'=> $model->getBannerList(),
              'value' => '$data->getBannerValue($data->article_isbanner)',
              'htmlOptions'=>array('width'=>'40px')),

        array('name'=>'create_user_id',
              'filter' => User::model()->getEnterpriseAdminList(Yii::app()->user->getId()),
              'value'  =>'$data->userTable->username',
              'htmlOptions'=>array('width'=>'60px')),

	    array('name'=>'article_create_gmt',
              //'value' => 'date("Ymd H:i:s", $data->article_create_gmt)',
              'value' => 'date("Y-m-d", $data->article_create_gmt)',
              'htmlOptions'=>array('width'=>'80px')),

        array(
                'class'=>'CButtonColumn',
                'template'=>'{update}{delete}',
                'htmlOptions'=>array('width=30px'),
                'headerHtmlOptions'=>array('width=34px'),
        ),
		/*
		'article_url',
		'article_icon',
		'article_tag',
		'article_content',
		'article_summary',
		'article_audit_gmt',
		'article_status',		
		'article_update_gmt',
		'article_click_count',
		'article_reject_reason',
		'audit_user_id',
		'enterprise_id',
		array(
			'class'=>'CButtonColumn',
		),
		*/

	),
)); ?>
