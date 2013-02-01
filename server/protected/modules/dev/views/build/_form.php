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
		<label>Branch List</label>
          <?php
              echo $form->dropDownList($model, 'branchId', $branchList);
          ?>
	</div>

	</br>
	<div class="row" id="buildStatus" name="buildStatus">
		<label>Build Status</label>
		<div class="row" id="status" name="status"></div>
	</div>

	</br>
	<div class="row" id="buildLog" name="buildLog">
		<label>Build log</label>
		<div class="row" id="log" name="log"></div>
	</div>


	</br>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Create', array('onclick' => 'return test()')); ?>
	</div>


<script type="text/javascript">    
function test()
{
    $("#status").html("building, please wait...");
    var enterpriseId = $("#Build_enterprise_id").val(); 
    var buildComments = $("#Build_build_comments").val();
    var buildTime = (new Date()).getTime();
    var branchName = $("#Build_branchId option:selected").text();
    //alert(enterpriseId + buildComments + buildTime + branchId);

    var url = "<?php echo Yii::app()->createUrl('dev/build/build'); ?>" + 
        "&enterpriseId=" + enterpriseId +
        "&branchName=" + branchName;
    if(buildComments)
    {
        url += "&buildComments=" + buildComments;
    }
    var myUrl = url;
    alert(url);
    var response = $.get(myUrl, {},
            function(data, status)
            {
                $("#status").html(status);
                $("#log").html(data);
            }
            );
    return false;
}
</script>
	
	
<?php $this->endWidget(); ?>

</div>
<!-- form -->