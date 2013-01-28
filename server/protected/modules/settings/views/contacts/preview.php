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


<form id="import" action="<?php echo YiiBase::app()->createUrl('settings/contacts/import'); ?>" method="post">
    <input type="hidden" value="<?php echo $filename;?>" name="filename" id="filename" />
    <div class="row buttons">
		<input type="submit" value="Import" />	
	</div>
	
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
                        'contacts_title',
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
    
    $permission = Permission::model()->findByPk('3');
    foreach($user as $model)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        'username',
                        'password',
                        'user_extra',
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
    foreach($userDepartment as $lineNo => $model)
    {
        $depNameArray = Array();
        foreach($model['department'] as $dep)
        {
            array_push($depNameArray, $dep->department_name);
        }
        $depString = implode(',', $depNameArray);
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        array('label'  => 'username',
                               'value' => $model['user']->username),
                        array('label'  => 'department',
                              'value'  =>  $depString),
                ),
        ));
        echo "</br>";
    }
?>

<?php
    if(count($badLine))
    {
        echo "<h2> Bad Line </h2>";
    } 
    foreach($badLine as $lineNo => $reason)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$reason,
                'attributes'=>array(
                        array('label'  => 'Line Number:',
                               'value' => $lineNo),
                        array('label'  => 'department',
                              'value'  => $reason),
            ),
        ));
        echo "</br>";
    }
?>

<?php
    if(count($duplicateUser))
    {
        echo "<h2> Duplicate User</h2>"; 
    } 
    foreach($duplicateUser as $dupLine => $origLine)
    {
        $this->widget('zii.widgets.CDetailView', array(
                'data'=>$origLine,
                'attributes'=>array(
                        array('label'  => 'Duplicate Line:',
                                'value' => $dupLine),
                        array('label'  => 'Original',
                                'value'  => $origLine),
                ),
        ));
        echo "</br>";
    }
?>

	<div class="row buttons">
		<input type="submit" value="Import" />	
	</div>
</form>