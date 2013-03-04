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
	
<?php
		 //generates following scripts
          /*
            $this->widget ( 'application.extensions.MUploadify.MUploadify', array (
                'name' => 'lgUpload',
                'auto' => true,
                'script' => array (
                        'theme/upload' 
                ),
                'onComplete' => 'js:function(event, queueID, fileObj, response, data)
                    {   
                        while(lgImage.firstChild)
                        {
                            var oldNode = lgImage.removeChild(lgImage.firstChild);
                            oldNode = null;
                        }
                        rArray = response.split(":");
                        if(rArray[0] == 0)
                        {
                            var html=\'<input type="hidden" value="\'+rArray[1]+\'" name="lgFile" id="lgFile" />\';
                            var imgChild = "<img src="+rArray[1]+ " style=\"max-width:100px\" />";
                            $("#lgImage").append(imgChild);
                        }
                        else
                        {
                            alert(rArray[1]);
                        }
                    }' 
            ) );
            */

$columns = array('bg' => 'background', 
			'lg' => 'logo', 
			'c1' => 'column1',
			'c2' => 'column2',
			'c3' => 'column3',
			'c4' => 'column4',
			'c5' => 'column5',
			'c6' => 'column6',
			'c7' => 'column7',
			'o1' => 'other1',
			'o2' => 'other2'
             );

function drawUploadControl($viewObject, $namePrefix)
	{
		$callbackStr = 'js:function(event, queueID, fileObj, response, data){';
		$callbackStr .= "while({$namePrefix}Image.firstChild){";
		$callbackStr .= "var oldNode = ${namePrefix}Image.removeChild({$namePrefix}Image.firstChild);oldNode = null;}";
		$callbackStr .= "rArray = response.split(':');if(rArray[0] == 0){";
		$nameStr = "{$namePrefix}File";
		$callbackStr .= 'var html=\'<input type="hidden" value="\'+rArray[1]+\'" name="' . $nameStr . '" id="'. $nameStr . '" />\';';
		$callbackStr .= 'var imgChild = "<img src="+rArray[1]+ " style=\"max-width:100px\" />";';
		$callbackStr .= "$('#{$namePrefix}Image').append(imgChild);}else{ alert(rArray[1]);}}";
		
		
		$viewObject->widget ( 'application.extensions.MUploadify.MUploadify', array (
				'name' => $namePrefix . 'Upload',
				'auto' => true,
				'script' => array (
						'theme/upload'
				),
				'onComplete' => $callbackStr));
	}
?>

	<div id="upload" name="upload">
        <label>Upload</label>
        <?php
			foreach($columns as $key => $value )
			{
				echo "<div id='$key' name='$key'>";
				echo "<span style='width:124px;display:-moz-inline-box;display:inline-block;'><strong>$value</strong></span>";
				drawUploadControl($this, $key);
				echo "</div>";
			}         
        ?>
        
        
        

	</div>
    <div id="fileDiv" name="fileDiv">
    </div>
	<div>
		<label>Theme Preview</label>
		<?php
			foreach($columns as $key => $value)
			{
				echo "<div id='{$key}Image' name='{$key}Image'></div>";
			} 
		?>
		
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