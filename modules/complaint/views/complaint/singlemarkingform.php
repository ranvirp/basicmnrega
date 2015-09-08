<?php
use app\modules\users\models\DesignationType;
?>
<script>
$(document).ready(function(){
$("input[type='radio']").change(function()
{
 if ($(this).val()=='otherdesignation')
 {
   $('#designation-select').show();
    $('#form2').hide();
}
else if ($(this).val()=='unregistered')
{
   $('#form2').show();
    $('#designation-select').hide();
    }
else {
 $('#designation-select').hide();
 $('#form2').hide();
}
});
});
</script>
  <div class="panel panel-primary">
  
  <div class="panel-heading">
    <h3 class="panel-title">Mark to Officer</h3>
  </div> 
<div class="panel-body">
<?php 
//if (Yii::$app->user->can('complaintadmin') || Yii::$app->user->can('complaintagent')) 
  $actions=['a'=>Yii::t('app','For Action'),'e'=>Yii::t('app','For Enquiry')];
//else
 // $actions=['e'=>Yii::t('app','For Enquiry')];
echo $form->field($modelComplaint,'marking[actiontype]')->dropDownList($actions)->label('Action Type');
?>
<div class="col-md-12">
<?= $form->field($modelComplaint,'marking[comment]')->textArea(['class'=>'hindiinput','onclick'=>'hindiEnable();return false;'])->label('Comment/Instruction')?>
</div>
<?php if (Yii::$app->user->can('marktopo')) {?>
            <div class="">
   <?php if ($modelComplaint->isNewRecord || is_numeric($modelComplaint->block_code)) {?>
  <label><input type="radio" name="maintype" value="po" checked>सम्बंधित खंड विकास अधिकारी</label>
  <?php } ?>
  <?php };?>
  <?php if (Yii::$app->user->can('marktoothers')) {?>
  <label><input type="radio" name="maintype" value="cdo">सम्बंधित मुख्य विकास अधिकारी</label>
 <label><input type="radio" name="maintype" value="dcmnrega">सम्बंधित उपायुक्त, श्रम रोजगार एवं नियोजन  </label>
 

<?php };?>
<?php if (Yii::$app->user->can('marktosqm')) {?>

  <label><input type="radio" name="maintype" value="sqm">सम्बंधित राज्य गुणवत्ता मॉनिटर</label>
<?php };?>
<?php if (Yii::$app->user->can('marktoothers')){ ?>
  <label><input type="radio" name="maintype" value="otherdesignation"  >Others</label>
   <label><input type="radio" name="maintype" value="unregistered"  >Other than registered users</label>

<?php } ?>
</div>
<div id="designation-select" style="display:none">

<?= $form->field($modelComplaint,'marking[otherdesignation]')->widget(\app\modules\users\widgets\DesignationWidget::className())->label(false)?>
</div>
 
<div id="form2" style="display:none">
<?= 
$form->field($modelComplaint,'marking[others][designation_type_id]')->dropDownList([DesignationType::otherTypes()])
//Designation::getDesignationByDistrict($district_code))
?>
<?= $form->field($modelComplaint,'marking[others][name]')->textInput(['class'=>'form-control hindiinput'])->label(Yii::t('app','Enquiry Officer'))?>
<?= $form->field($modelComplaint,'marking[others][mobileno]')->textInput()->label(Yii::t('app','Mobile No'.'of'.'Enquiry Officer'))?>

</div>

   <?= $form->field($modelComplaint,'marking[deadline]')->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
])->label(Yii::t('app','Deadline'))?>

</div>
</div>