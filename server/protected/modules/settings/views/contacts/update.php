<?php
/* @var $this ContactsController */
/* @var $model Contacts */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	$model->contacts_id=>array('view','id'=>$model->contacts_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Create Contacts', 'url'=>array('create')),
	array('label'=>'View Contacts', 'url'=>array('view', 'id'=>$model->contacts_id)),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
);
?>

<h1>Update Contacts <?php echo $model->contacts_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>