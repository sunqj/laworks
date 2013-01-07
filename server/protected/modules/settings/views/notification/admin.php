<?php
/* @var $this NotificationController */
/* @var $model Notification */

$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Create Notification', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notification-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Notifications</h1>

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
	'id'=>'notification-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'notification_name',
		'notification_desc',

		array('name'=>'create_user_id',
		'filter' => User::model()->getEnterpriseAdminList(Yii::app()->user->getId()),
		'value'  =>'$data->userTable->username',
		'htmlOptions'=>array('width'=>'100px')),
		array('name'=>'notification_create_gmt',
		'value' => 'date("Y-m-d H:i:s", $data->notification_create_gmt)',
		),
		/*
		'create_user_id',
		'notification_create_gmt',
		'notification_url',
		'notification_id',
		'notification_audit_gmt',
		'notification_status',
		'department_id',
		'audit_user_id',
		'enterprise_id',

		*/
        array(
                'class'=>'CButtonColumn',
                'template'=>'{update}{delete}',
                'htmlOptions'=>array('width=30px'),
                'headerHtmlOptions'=>array('width=34px'),
        ),
	),
)); ?>
