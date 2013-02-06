<?php
/* @var $this ThemeController */
/* @var $model Theme */
/* @var $form CActiveForm */
?>

<div class="form">

<?php

$form = $this->beginWidget ( 'CActiveForm', array (
        'id' => 'theme-form',
        'enableAjaxValidation' => false 
) );
?>

	<p class="note">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'theme_name'); ?>
		<?php echo $form->textField($model,'theme_name',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'theme_name'); ?>
	</div>
	<div id="upload" name="upload">
        <label>Upload</label>
        <div id="background" name="background">
        <span style="width:124px;display:-moz-inline-box;display:inline-block;"><strong>background</strong></span><?php
        $this->widget ( 'application.extensions.MUploadify.MUploadify', array (
            'name' => 'bgUpload',
            'auto' => true,
            'script' => array (
                    'theme/upload' 
            ),
            'onComplete' => 'js:function(event, queueID, fileObj, response, data)
                {   
                    while(fileDiv.firstChild)
                    {
                        var oldNode = fileDiv.removeChild(fileDiv.firstChild);
                        oldNode = null;
                    }
                    rArray = response.split(":");
                    if(rArray[0] == 0)
                    {
                        alert(rArray[1]);
                        var html=\'<label>上传成功</label><input type="hidden" value="\'+rArray[1]+\'" name="bgFile" id="bgFile" />\';
                        $("#fileDiv").append(html);
                        
                    }
                    else
                    {
                        alert(rArray[1]);
                    }
                }' 
        ) );
        ?>
        </div>
        
        <div id="lg" name="lg">
         <span style="width:124px;display:-moz-inline-box;display:inline-block;"><strong>logo</strong></span>
         <?php
            $this->widget ( 'application.extensions.MUploadify.MUploadify', array (
                    'name' => 'lgUpload',
                    'auto' => true,
                    'script' => array (
                            'theme/upload' 
                    ),
                    'onComplete' => 'js:function(event, queueID, fileObj, response, data)
                    {   
                        while(fileDiv.firstChild)
                        {
                            var oldNode = fileDiv.removeChild(fileDiv.firstChild);
                            oldNode = null;
                        }
                        rArray = response.split(":");
        
                        if(rArray[0] == 0)
                        {
                            var html=\'<label>上传成功</label><input type="hidden" value="\'+rArray[1]+\'" name="lgFile" id="lgFile" />\';
                            //alert(rArray[1]);
                            //alert(html);
                            $("#fileDiv").append(html);
                            
                        }
                        else
                        {
                            alert(rArray[1]);
                        }
                   }' 
            ) );
            ?>
        </div>

        <div id="column1" name="column1">
        <span style="width:120px;display:-moz-inline-box;display:inline-block;"><strong>column1</strong></span>
        <?php
            $this->widget ( 'application.extensions.MUploadify.MUploadify', array (
                    'name' => 'c1Upload',
                    'auto' => true,
                    'script' => array (
                            'theme/upload' 
                    ),
                    'onComplete' => 'js:function(event, queueID, fileObj, response, data)
                    {   
                        while(fileDiv.firstChild)
                        {
                            var oldNode = fileDiv.removeChild(fileDiv.firstChild);
                            oldNode = null;
                        }
                        rArray = response.split(":");
                        alert("result:" + rArray[0] + ":" + rArray[1]);
                        if(rArray[0] == 0)
                        {
                            var html=\'<label>上传成功</label><input type="hidden" value="\'+rArray[1]+\'" name="c1File" id="c1File" />\';
                            $("#fileDiv").append(html);
                            
                        }
                        else
                        {
                            alert(rArray[1]);
                        }
                   }' 
            ) );
            ?>
		</div>

		<div id="column2" name="column2">
        <span  style="width:120px;display:-moz-inline-box;display:inline-block;"><strong>column2</strong></span>
        <?php
            $this->widget ('application.extensions.MUploadify.MUploadify', array (
                    'name' => 'c2Upload',
                    'auto' => true,
                    'script' => array (
                            'theme/upload' 
                    ),
                    'onComplete' => 'js:function(event, queueID, fileObj, response, data)
                    {   
                        while(fileDiv.firstChild)
                        {
                            var oldNode = fileDiv.removeChild(fileDiv.firstChild);
                            oldNode = null;
                        }
                        rArray = response.split(":");
        
                        if(rArray[0] == 0)
                        {
                            var html=\'<label>上传成功</label><input type="hidden" value="\'+rArray[1]+\'" name="c2File" id="c2File" />\';
                            //alert(rArray[1]);
                            //alert(html);
                            $("#fileDiv").append(html);
                            
                        }
                        else
                        {
                            alert(rArray[1]);
                        }
                   }' 
            ) );
            ?>
		
		
		</div>
	</div>
    <div id="fileDiv" name="fileDiv">
    </div>
	<div>
		<label>Theme Preview</label>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->dropDownList($model, 'enterprise_id', Enterprise::model()->getEnterpriseList()); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form -->