<?php
/* @var $this BuildController */
/* @var $model Build */
/* @var $form CActiveForm */
?>

<div class="form">
<?php Yii::app ()->clientScript->registerCoreScript ("jquery"); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'build-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'build_comments'); ?>
		<?php echo $form->textField($model,'build_comments',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'build_comments'); ?>
	</div>

	</br>
	<div class="row">
		<?php echo $form->labelEx($model,'enterprise_id'); ?>
		<?php echo $form->dropDownList($model, 'enterprise_id', Enterprise::model()->getEnterpriseList()); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>

	</br>
	<div class="row">
		<?php echo $form->labelEx($model,'build_type'); ?>
		<?php echo $form->dropDownList($model, 'build_type', Build::model()->getBuildTypeList()); ?>
		<?php echo $form->error($model,'enterprise_id'); ?>
	</div>
	
	</br>
	<div class="row">
		<label>Branch List</label>
          <?php
              echo $form->dropDownList($model, 'branchId', $branchList);
          ?>
	</div>

	</br>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Build', array('onclick' => 'return test()', 
		                    'id'    =>'submit', 
		                    'name'  =>'submit')); ?>
	</div>
	
	
	</br>
	<div class="row">
		<label>Request Status</label>
		<div class="row" id="requestStatus" name="requestStatus"></div>
	</div>
	
	</br>
	<div class="row">
		<label>Tips</label>
		<div class="row" id="tips" name="tips"></div>
	</div>
	
	</br>
	<div class="row">
		<label>Build Status</label>
		<div class="row" id="buildStatus" name="buildStatus"></div>
	</div>

	</br>
	<div class="row">
		<label>Build log</label>
		<div class="row" id="buildLog" name="buildLog"></div>
	</div>

<script type="text/javascript">    
function test()
{
    if($("#submit").val() == 'Create')
    {
        return true;
    }

    $("#submit").attr({"disabled":"disabled"});
    $("#buildStatus").html("building, it will take about 1 minute, please wait...");
    var enterpriseId = $("#Build_enterprise_id").val(); 
    var buildComments = $("#Build_build_comments").val();
    var buildDate = parseInt((new Date()).getTime() / 1000);
    var branchName = $("#Build_branchId option:selected").text();

    var url = "<?php echo Yii::app()->createUrl('dev/build/build'); ?>" ;

    var response = $.get(url, 
            {
              'branchName'  : branchName,
              'enterpriseId': enterpriseId,
              'timeStamp'   : buildDate,
            },
            function(data, status)
            {
                $("#requestStatus").html(status);
                var htmlContent = "build command return value: " + data.retval + "</br>";
                $("#buildStatus").html(htmlContent);
                htmlContent += "build command output: </br>==========</br>"; 
                htmlContent += data.output;
                htmlContent += "</br>==========</br>";
                $("#buildLog").html(htmlContent);
                if(data.retval)
                {
                    $("#tips").html("<font color=red>build got some errors, " +
                            "please refer to build output for details</font>");
                }
                else
                {   
                    var htmlContent = "<font color=blue>build is ok," + 
                        "please click 'Create' to create database entry</font>";

                    htmlContent += '<input type=hidden id=Build_build_date name=Build[build_date] value="' 
                        + buildDate + '" />';

                    htmlContent += '<input type=hidden id=Build_build_version name=Build[build_version] value="' 
                        + branchName + "-" + buildDate + '" />';
                    
                    $("#tips").html(htmlContent);
                    $("#submit").val("Create");
                    $("#submit").removeAttr("disabled");
                }
            },
            'json'
            );
    return false;
}
</script>
	
	
<?php $this->endWidget(); ?>

</div>
<!-- form -->