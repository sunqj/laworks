<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
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

<h1>Manage Users</h1>

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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array('name' => 'username', 'type' => 'raw',
              'value'=>'CHtml::link($data->username,array("user/view", "id"=>$data->user_id), array("target"=>"_blank"))',
              'htmlOptions' => array('width' => '160')),
        array('name'  => 'permission_id',
              'filter'=> Permission::model()->getNormalPermissionList(),
              'value' => '$data->permissionTable->permission_name',
              'htmlOptions' => array('width'=>'120px')),
        array('name' => 'user_position', 'htmlOptions' => array('width' => '100')),
        array('name' => 'user_realname', 'htmlOptions' => array('width' => '100')),
		/*
		'user_cell',
		'user_realname',
		'username',
		'permission_id',
		'user_id',
		'user_image',
		'user_email',
		'user_status',
		'user_hometel',
		'user_officetel',
		'user_login_count',
		'user_last_login_time',
		'user_last_check_time',
		'user_other',
		'user_extra',
		'password',
		'enterprise_id',
		*/
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'htmlOptions'=>array('width=30px'),
            'headerHtmlOptions'=>array('width=34px')
        ),
	),
)); ?>
