<?php
/* @var $this VoteController */
/* @var $model Vote */
/* @var $form CActiveForm */
?>


<script type="text/javascript">  
var idNumber = 1,id="tableAFS";
function addTextBox(text) 
{
    idNumber++;  
    //create label 
    label0 = document.createElement("label");  
    label0.setAttribute("id","label"+idNumber);  
    //create input box
    var textField = document.createElement("input");  
    textField.setAttribute("type","text");  
    textField.setAttribute("name","Vote[vote_options][]");  
    textField.setAttribute("id","Title"+idNumber);  
    if (text)
    {
        textField.setAttribute("value",text);
    }
    label0.appendChild(textField);  
    //创建按钮  
    var textField2 = document.createElement("input");  
    textField2.setAttribute("type","button");  
    textField2.setAttribute("name","button");  
    textField2.setAttribute("value","删除选项");  
    textField2.onclick=function(){removeTextBox(this)}  
    label0.appendChild(textField2);  

    document.getElementById(id).appendChild(label0);  
}  
function removeTextBox(o) 
{  
    var t=document.getElementById(id).getElementsByTagName("label").length;  
    if ( t> 1)  //如果超过1个textbox  
        document.getElementById(id).removeChild(o.parentNode);  
}  
function show()  
{  
    var t=document.getElementById(id).getElementsByTagName("label").length;  
    var allText = document.getElementById(id).getElementsByTagName("input");  
    var s = "";  
    for(i=0;i<allText.length;i++)  
    {  
        if(allText[i].id.indexOf('Title')=="0")
        {   
            s = s+allText[i].value + "\n" ;  
        }
    }  
    alert(s);  
}
</script>


<style type="text/css">
<!--
label {
  display:block;
  margin:.25em 0em;  
}  
-->   
</style>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vote-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_type'); ?>
		<?php echo $form->dropDownList($model, 'vote_type', Vote::getVoteTypeList()); ?>
		<?php echo $form->error($model,'vote_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_name'); ?>
		<?php echo $form->textField($model,'vote_name',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'vote_name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'vote_summary'); ?>
		<?php echo $form->textField($model,'vote_summary',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'vote_summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vote_content'); ?>
		<?php echo $form->textField($model,'vote_content',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'vote_content'); ?>
	</div>
    <label><h5>投票选项</h5></label>
    <input name="button" type="button" onClick="addTextBox()" value="增加一项" />
    <div id="tableAFS"> </div>
    

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->