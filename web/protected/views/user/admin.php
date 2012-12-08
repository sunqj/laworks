<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'用户'=>array('index'),
	'用户管理',
);

$this->menu=array(
	array('label'=>'用户查看', 'url'=>array('index')),
	array('label'=>'用户创建', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>用户管理</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('高级查找','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_id',
		'username',
		'password',
		'user_cell',
		'user_other',
		'user_extra',
		/*
		'user_image',
		'user_email',
		'user_status',
		'user_hometel',
		'user_realname',
		'user_position',
		'user_officetel',
		'user_login_count',
		'user_last_login_time',
		'user_last_check_time',
		'permission_id',
		'enterprise_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
