<?php
/* @var $this BuildController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Builds',
);

$this->menu=array(
	array('label'=>'Create Build', 'url'=>array('create')),
	array('label'=>'Manage Build', 'url'=>array('admin')),
);
?>

<h1>Builds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
