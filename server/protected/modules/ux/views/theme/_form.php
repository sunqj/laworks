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
<script type="text/javascript">
function setDropDownListData(obj)
{
	var eid = $("#" + obj.id).val();
	var url = "<?php echo Yii::app()->createUrl('settings/column/list'); ?>" ;

    var response = $.get(url, 
            {
              'eid': eid,
            },
            function(data, status)
            {
				var dList = $("#column_div").find('select');
				alert(dList.length);
				$.each(data, function(key, value)
						{
							alert(key);
							alert(value);
						}
						);
				for(var i = 0; i < dList.length; ++i)
				{
					dList[i].remove();
					$.each(data, function(key, value)
							{
								dList[i].options.add(new Option(value, key));
							}
							);
					
				}
            },'json');
}
</script>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'theme_name'); ?>
		<?php echo $form->textField($model,'theme_name',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'theme_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->dropDownList($model, 'enterprise_id', Enterprise::model()->getEnterpriseList(), 
				array('empty' => 'select an enterprise',
					  'onchange' => 'setDropDownListData(this)'	)); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
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

$uiImages = array('banner' => 'banner',
			'lg' => 'logo', 
			'bg' => 'background',
			);


$columnImages = array(
			'c1' => 'column1',
			'c2' => 'column2',
			'c3' => 'column3',
			'c4' => 'column4',
			'c5' => 'column5',
			'c6' => 'column6',
			'c7' => 'column7',
             );
$otherImages = array('o1' => '通讯录',
			'o2' => '内部通知',
			'o3' => '设置',
			);

function drawUploadControl($viewObject, $namePrefix)
	{
		$callbackStr = 'js:function(event, queueID, fileObj, response, data){';
		$callbackStr .= "rArray = response.split(':');if(rArray[0] == 0){";
		$callbackStr .= "$('#{$namePrefix}Image').attr('src', rArray[1]);";
		$callbackStr .= "}else{ alert(rArray[1]);}}";
		
		
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
			foreach($uiImages as $key => $value )
			{
				echo "<div id='{$key}_div' name='{$key}_div'>";
				echo "<span style='width:124px;display:-moz-inline-box;display:inline-block;'><strong>$value</strong></span>";
				drawUploadControl($this, $key);
				echo "</div>";
			}
			echo "</br>";
		?>
		
		<div id="column_div" name="column_div">
		<?php 
			foreach($columnImages as $key => $value )
			{
				echo "<div id='{$key}_div' name='{$key}_div'>";
				$cnameCss = "width:124px;display:-moz-inline-box;display:inline-block;";
				$dropDownStr = CHtml::dropDownList('icon', '', array(), 
					array('empty' => '--'));
				echo "<span style='$cnameCss'><strong>$value</strong> &nbsp&nbsp $dropDownStr</span>";
				drawUploadControl($this, $key);
				echo "</div></br>";
			}
        ?>
        </div>
        
        <div id="other_div" name="other_div">
		<?php 
			foreach($otherImages as $key => $value )
			{
				echo "<div id='{$key}_div' name='{$key}_div'>";
				$cnameCss = "width:124px;display:-moz-inline-box;display:inline-block;";
				$dropDownStr = CHtml::dropDownList('icon', '', array(), 
					array('empty' => '---'));
				echo "<span style='$cnameCss'><strong>$value</strong>&nbsp&nbsp$dropDownStr</span>";
				drawUploadControl($this, $key);
				echo "</div></br>";
			}
        ?>
        </div>
        
     </div>  


     
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>

<!-- form -->
<style type="text/css">
.mainFrame {width:480px; margin:0px auto; padding:0px;}
.banner{float:left;z-index:1;width:480px; margin:0px auto; padding:0px;}
.lg{margin-left:-480px;}
.ename{margin-left:0px;margin-top:5px;}
.bg{ float:left;z-index:1; display:inline;} 
.c1{ margin-top: -650px;margin-left: 10px;}
.c2{ margin-top: -650px;margin-left: 175px; }
.c3{ margin-top: -650px;margin-left: 340px; margin-right:5px;}
.c4{ margin-top: -420px;margin-left: 10px;}
.c5{ margin-top: -420px;margin-left: 175px;}
.c6{ margin-top: -420px;margin-left: 340px; margin-right:5px;}
.c7{ margin-top: -190px;margin-left: 10px;}
.o1{ margin-top: -190px;margin-left: 175px;}
.o2{ margin-top: -190px;margin-left: 340px; margin-right:5px;}

.c1,.c2,.c3,.c4,.c5,.c6,.c7,.o1,.o2,.lg,.ename
{
    text-align:center;float:left;z-index:2;display:inline;*margin-left:0px;
}
</style>
	
	<div>
		<label>Theme Preview</label>
	</div>
	
	<div class="mainFrame">

     	<?php
			foreach((array_merge($uiImages, $columnImages)) as $key => $value )
			{
				echo "<div class='$key' name='$key' id='$key'>";
				$imgStr = "<img id='{$key}Image' src='/server/static/theme/{$key}'";
				if($key == 'lg')
				{
					$imgStr .= 'style="margin-top:5px;max-width:30px"/>';
					echo $imgStr;
// 					echo "</div>";
// 					echo '<div class="ename" >企业名称 </div>';
// 					continue;
				}
				else if($key == 'bg' || $key == 'banner')
				{
					$imgStr .= '/>';
					echo $imgStr;
				}
				else 
				{
					$imgStr .= "style='max-width:120px' />";
					echo $imgStr;
					echo "</br>";
					echo "$value";
				}
				echo "</div>";
			}         
        ?>
</div>