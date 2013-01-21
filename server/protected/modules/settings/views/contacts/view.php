<?php
/* @var $this ContactsController */
/* @var $model Contacts */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->contacts_id,
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'Update Contacts', 'url'=>array('update', 'id'=>$model->contacts_id)),
	array('label'=>'Delete Contacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contacts_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);
?>

<h1>View Contacts #<?php echo $model->contacts_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contacts_id',
		'contacts_name',
		'contacts_cell',
		'contacts_hometel',
		'contacts_officetel',
		'user_id',
	),
)); ?>
