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

    if(eid == "")
    {
        dList = $("#column_div").find("select");
        for(var i = 0; i < dList.length; ++i)
        {
        	dList[i].options.length = 0;
        	dList[i].options.add(new Option("--", ""));
        }
        return;
    }

    var response = $.get(url, 
            {
              'eid': eid,
            },

            function(data, status)
            {
				var dList = $("#column_div").find('select');
				
				for(var i = 0; i < dList.length; ++i)
				{
					dList[i].options.length = 0;
					dList[i].options.add(new Option('--', '0'));
					$.each(data.userColumns, function(key, value)
								{
					                dList[i].options.add(new Option(value, key));
								}
							);
					dList[i].options.add(new Option('--', '0'));
					$.each(data.dummyColumns, function(key, value)
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
                            $('#{$namePrefix}Image').attr('src', rArray[1]);
		                    var label = $('#Theme_theme_{$namePrefix} option:selected').text();
		                    $('#{$namePrefix}Label').text(label);
                        }
                        else
                        {
                            alert(rArray[1]);
                        }
                    }' 
            ) );
            */

$uiImages = array(
			'banner' => 'banner',
			'lg' => 'logo', 
			'bg' => 'background',
			);

$columnImages = array();
for ($i = 1; $i <= 12; ++$i)
{
    $columnImage = $i > 9 ? "c$i" : "c0$i";
    array_push($columnImages, $columnImage);
}

function drawUploadControl($viewObject, $namePrefix)
	{
		$callbackStr = 'js:function(event, queueID, fileObj, response, data){';
		$callbackStr .= "rArray = response.split(':');if(rArray[0] == 0){";
		$callbackStr .= "$('#{$namePrefix}Image').attr('src', rArray[1]);";
		$callbackStr .= "var label = $('#Theme_theme_{$namePrefix} option:selected').text();";
		$callbackStr .= "$('#{$namePrefix}Label').text(label);";
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
        <div><h2>UI Elements</h2></div>
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
		
		<div><h2>Main Columns</h2></div>
		<div id="column_div" name="column_div">
		<?php 
			foreach($columnImages as $key )
			{
				$labelStr =  $form->labelEx($model,"theme_$key");
				echo "<div id='{$key}_div' name='{$key}_div'>";
				$cnameCss = "width:124px;display:-moz-inline-box;display:inline-block;";
				$dropDownStr = $form->dropDownList($model, "theme_$key", array(), array('empty' => '--'));
				echo "<span style='$cnameCss'><strong>$labelStr</strong> &nbsp&nbsp$dropDownStr</span>";
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
</div><!--end form -->

<style type="text/css">
.mainFrame {width:480px; margin:0px auto; padding:0px;}
.banner{float:left;z-index:1;width:480px; margin:0px auto; padding:0px;}
.lg{margin-left:-480px;}
.ename{margin-left:0px;margin-top:5px;}
.bg{ float:left;z-index:1; display:inline;} 
.c01{ margin-top: -650px;margin-left: 10px;}
.c02{ margin-top: -650px;margin-left: 175px; }
.c03{ margin-top: -650px;margin-left: 340px; margin-right:5px;}
.c04{ margin-top: -420px;margin-left: 10px;}
.c05{ margin-top: -420px;margin-left: 175px;}
.c06{ margin-top: -420px;margin-left: 340px; margin-right:5px;}
.c07{ margin-top: -190px;margin-left: 10px;}
.c08{ margin-top: -190px;margin-left: 175px;}
.c09{ margin-top: -190px;margin-left: 340px; margin-right:5px;}
.c10{ margin-top: 40px;margin-left: 10px;}
.c11{ margin-top: 40px;margin-left: 43px;}
.c12{ margin-top: -139px;margin-left: 340px; margin-right:5px;}
.c01,.c02,.c03,.c04,.c05,.c06,.c07,.c08,.c09,.c10,.c11,.c12,.lg,.ename
{
    text-align:center;float:left;z-index:2;display:inline;*margin-left:0px;
}
</style>
	
	<div>
		<label>Theme Preview</label>
	</div>
	
	<div class="mainFrame">

     	<?php
     		foreach($uiImages as $key => $value)
     		{
     			echo "<div class='$key' name='$key' id='$key'>";
     			$imgStr = "<img id='{$key}Image' src='/server/static/theme/{$key}'";
     			if($key == 'lg')
     			{
     				$imgStr .= 'style="margin-top:5px;max-width:30px"/>';
     				echo $imgStr;
     			}
     			else if($key == 'bg' || $key == 'banner')
				{
     			$imgStr .= '/>';
     			echo $imgStr;
     			}
     			echo "</div>";
     		}
			foreach($columnImages as $key )
			{
				echo "<div class='$key' name='$key' id='$key'>";
				$imgStr = "<img id='{$key}Image' src='/server/static/theme/{$key}'";
				$imgStr .= "style='max-width:120px' />";
				echo $imgStr;
				echo "</br>";
				echo  $form->labelEx($model,"theme_$key", array('id' => "{$key}Label"));

				echo "</div>";
			}         
        ?>
</div>