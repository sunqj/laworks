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
	
	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->dropDownList($model, 'enterprise_id', Enterprise::model()->getEnterpriseList()); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
</div>
<!-- form -->
<style type="text/css">
.mainFrame {width:480px; margin:0px auto; padding:0px;}
.banner{float:left;z-index:1;width:480px; margin:0px auto; padding:0px;}
.logo{margin-left:-480px;}
.ename{margin-left:-430px;margin-top:5px;}
.bg{ float:left;z-index:1; display:inline;} 
.c1{ margin-top: -650px;margin-left: 5px;}
.c2{ margin-top: -650px;margin-left: 172px; }
.c3{ margin-top: -650px;margin-left: 340px; margin-right:5px;}
.c4{ margin-top: -420px;margin-left: 5px;}
.c5{ margin-top: -420px;margin-left: 172px;}
.c6{ margin-top: -420px;margin-left: 340px; margin-right:5px;}
.c7{ margin-top: -190px;margin-left: 5px;}
.c8{ margin-top: -190px;margin-left: 172px;}
.c9{ margin-top: -190px;margin-left: 340px; margin-right:5px;}

.c1,.c2,.c3,.c4,.c5,.c6,.c7,.c8,.c9,.logo,.ename
{
    text-align:center;float:left;z-index:2;display:inline;*margin-left:0px;
}
</style>
	
	<div>
		<label>Theme Preview</label>
	</div>
	
	<div class="mainFrame">
    <!-- header --!>
    <div class="banner"><img src="/server/static/theme/banner.png" /></div>

    <!-- logo --!>
    <div class="logo">
        <img src="/server/static/theme/lg.png" style="margin-top:5px;max-width:30px"/>
    </div>

    <!-- enterprise name --!>
    <div class="ename">
        企业名称
    </div>

    <!-- bg --!>
    <div class="bg"><img src="/server/static/theme/bg.png" /></div>

    <!-- 1st row --!>
    <div class="c1">
        <img src="/server/static/theme/c1.png" />
        </br>
        工作动态
    </div>
    <div class="c2">
        <img src="/server/static/theme/c2.png" />
        </br>
        突发事件
    </div>
    <div class="c3">
        <img src="/server/static/theme/c3.png" />
        </br>
        公共信息
    </div>

    <!-- 2nd row --!>
    <div class="c4">
        <img src="/server/static/theme/c4.png" />
        </br>
        值班安排
    </div>
    <div class="c5">
        <img src="/server/static/theme/c5.png" />
        </br>
        值班要情
    </div>
    <div class="c6">
        <img src="/server/static/theme/c6.png" />
        </br>
        视频监控
    </div>

    <!-- 3rd row --!>
    <div class="c7" name="c7" id="c7">
        <img src="/server/static/theme/c7.png" />
        </br>
        通讯录
    </div>
    <div class="c8" name="o1" id="o1">
        <img src="/server/static/theme/o1.png" />
        </br>
        内部通知
    </div>
    <div class="c9" name="o2" id="o2">
        <img src="/server/static/theme/o2.png" />
        </br>
        设置
    </div>
