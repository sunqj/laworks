<?php
/* @var $this ContactsController */
/* @var $model Contacts */

$this->breadcrumbs=array(
	'Contacts'=>array('index'),
	'Import',
);

$this->menu=array(
	array('label'=>'List Contacts', 'url'=>array('index')),
	array('label'=>'Manage Contacts', 'url'=>array('admin')),
    array('label'=>'Import Contacts', 'url' => array('upload')),
);


?>

<h1>Preview Result</h1>

<?php
    if(count($contacts))
    {
        echo "<h2>Contacts </h2>";
    } 

    foreach($contacts as $model)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        'contacts_name',
                        'contacts_cell',
                        'contacts_hometel',
                        'contacts_officetel',
                ),
        ));
        echo "</br>";
    }
?>


<?php
    if(count($user))
    {
        echo "<h2>User </h2>";
    } 

    foreach($user as $model)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        'username',
                        'password',
                        'permission_id',
                        'enterprise_id',
                ),
        ));
        echo "</br>";
    }
?>

<?php 
    if(count($department))
    {
        echo "<h2>Department </h2>";
    }
    foreach ($department as $model)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        'department_name',
                ),
        ));
        echo "</br>";
    }
?>

<?php
    if(count($userDepartment))
    {
        echo "<h2> User Department </h2>";
    } 
    foreach($userDepartment as $model)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        'department_id',
                        'user_id',
                ),
        ));
        echo "</br>";
    }

?>
