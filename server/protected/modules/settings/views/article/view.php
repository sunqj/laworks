<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->article_name,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->article_id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->article_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<h1>View Article #<?php echo $model->article_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'article_tag',
		//'article_url',
        //'article_icon',
        //'article_type',
	    //'article_content',
        //'enterprise_id',
        //'article_reject_reason',
	    array('label' => 'Article name',
                'type' => 'raw',
                'value' => CHtml::link($model->article_name, array(
                'article/view', 'id' => $model->article_id ))),
	    'article_summary',
	    array('label' => 'Is Banner',
	          'value' => $model->getBannerValue($model->article_isbanner)),
        array('label' => 'Article Type',
              'value' => $model->contentTypeTable->content_type_name),
        array('label' => 'Article Create Time',
              'value' => date('Y-m-d H:i:s', $model->article_create_gmt)),
        array('label' => 'Article Update Time',
              'value' => date('Y-m-d H:i:s', $model->article_update_gmt)),
        array('label' => 'Article Audit Time',
              'value' => date('Y-m-d H:i:s', $model->article_audit_gmt)),
        array('label' => 'Article Status',
              'value' => $model->contentStatusTable->content_status_name),
        array('label' => 'Column',
              'value' => $model->columnTable->column_name),
		array('label' => 'Create User', 
              'value' => $model->userTable->username),
        array('label' => 'Audit User', 
              'value' => $model->userTable->username),
        'article_click_count',
        array(
                'label' => 'Article icon',
                'type' => 'raw',
                'value' => CHtml::image($model->article_icon, 'Article icon', array('style' => 'max-width:100px'))),
	),
)); ?>
