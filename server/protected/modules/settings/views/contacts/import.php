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
    array('label'=>'Import Contacts', 'url' => array('import')),
);


?>

<h1>Import Contacts</h1>

	<div class="row">
		<?php $this->widget('application.extensions.MUploadify.MUploadify',array(
                'name'=> 'test',
		        'auto'=>true,
		        'script'=>array('contacts/upload'),
		        'onComplete'=>'js:function(event, queueID, fileObj, response, data)
		            {
		                while(img_prev.firstChild)
		                {
		                    var oldNode = img_prev.removeChild(img_prev.firstChild);
		                    oldNode = null;
		                }
		                rArray = response.split(":");

		                if(rArray[0] == 0)
		                {
		                    var imgChild = "<img src="+rArray[1]+ " style=\"max-width:100px\" />";
		                    $("#img_prev").append(imgChild);
		                    $("#ytArticle_article_icon").val(rArray[1]);
		                }
		                else
		                {
		                    alert(rArray[1]);
		                }
                    }',            
            ));
		?>
	</div>