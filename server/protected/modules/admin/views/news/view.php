<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->news_id,
);

$this->menu=array(
	array('label'=>'List News', 'url'=>array('index')),
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Update News', 'url'=>array('update', 'id'=>$model->news_id)),
	array('label'=>'Delete News', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->news_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>View News #<?php echo $model->news_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'news_id',
		'news_name',
	    'news_summary',
        array(
                'label' => 'News icon',
                'type' => 'raw',
                'value' => CHtml::image($model->news_icon, 'news icon', array('style' => 'max-width:100px')),
                ),
	    array(
	            'label' => 'News Type',
	            'value' => $model->contentTypeTable->content_type_name,
	         ),
        array(
                'label' => 'News audit time',
                'value' => date('Y-m-d', $model->news_audit_gmt)
             ),
		array(
                'label' => 'News create time',
                'value' => date('Y-m-d', $model->news_create_gmt)
             ),
        array(
                'label' => 'News update time',
                'value' => date('Y-m-d', $model->news_update_gmt)
             ),

        array(
                'label' => 'News status',
                'value' => $model->contentStatusTable->content_status_name,
            ),
        array(
                'label' => 'News Channel',
                'value' => $model->channelTable->channel_name,
            ),
        array(
                'label' => 'Create user id',
                'value' => $model->userTable->username,
            ),
        array(
                'label' => 'Audit user id',
                'value' => $model->userTable->username,
            ),
        'news_click_count',
        'news_url',
        'news_content',
	),
)); ?>
