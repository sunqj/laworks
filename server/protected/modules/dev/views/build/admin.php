<?php
/* @var $this BuildController */
/* @var $model Build */

$this->breadcrumbs=array(
	'Builds'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Build', 'url'=>array('index')),
	array('label'=>'Create Build', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('build-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Builds</h1>

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
	'id'=>'build-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array('name'  => 'build_version',
            'type'    => 'raw',
            'value'   => 'CHtml::link($data->build_version, array("build/view", "id"=>$data->build_id))', 
            //'htmlOptions' => array('width' => '40px')
            ),
        'build_comments',
		array('name'  => 'build_date',
              'value' => 'date("Y-m-d", $data->build_date)',  
              'htmlOptions' => array('width' => '70px')),


        array('name'=>'enterprise_id',
        'filter' => Enterprise::model()->getEnterpriseList(),
        'value'  => '$data->enterpriseTable->enterprise_name',
        'htmlOptions'=>array('width'=>'60px')),

        array(
                'class'=>'CButtonColumn',
                'template'=>'{delete}',
                'htmlOptions'=>array('width=30px'),
                'headerHtmlOptions'=>array('width=34px'),
        ),
	),
)); ?>
