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

<h1>Import Contacts</h1>
<form id="importForm" action="<?php YiiBase::app()->createUrl('preview'); ?>" method="post">
	<div class="row">
		<?php $this->widget('application.extensions.MUploadify.MUploadify',array(
                'name'=> 'excelUpdload',
		        'auto'=>true,
		        'script'=>array('contacts/excelupload'),
		        'onComplete'=>'js:function(event, queueID, fileObj, response, data)
		            {   
		                while(fileDiv.firstChild)
		                {
		                    var oldNode = fileDiv.removeChild(fileDiv.firstChild);
		                    oldNode = null;
		                }
		                rArray = response.split(":");

		                if(rArray[0] == 0)
		                {
		                    var html=\'<label>上传成功</label><input type="hidden" value="\'+rArray[1]+\'" name="uploadFile" id="uploadFile" />\';
		                    //alert(rArray[1]);
		                    //alert(html);
		                    $("#fileDiv").append(html);
		                    
		                }
		                else
		                {
		                    alert(rArray[1]);
		                }
                    }',            
            ));
		?>
		
	</div>
	
	<p> </p>
	
	<div class="row" id="fileDiv">
	    
	</div>
	
	<div class="row buttons">
		<input type="submit" value="Preview" />	
	</div>
	</form>