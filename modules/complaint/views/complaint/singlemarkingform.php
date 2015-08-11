<?php
use app\modules\users\models\DesignationType;
?>
<div class="col-md-12">
<?=\yii\helpers\Html::textArea('marking[comment]','',['class'=>'hindiinput','onclick'=>'hindiEnable();return false;'])?>
</div>
  <div class="col-md-12"><span>Mark to Officer</span></div> 
<?php if (Yii::$app->user->can('marktopo')) {?>
            <div class="checkbox">
   <?php if (is_numeric($modelComplaint->block_code)) {?>
  <label><input type="radio" name="maintype" value="po" checked>सम्बंधित खंड विकास अधिकारी</label>
  <?php } ?>
  <label><input type="radio" name="maintype" value="cdo">सम्बंधित मुख्य विकास अधिकारी</label>
 <label><input type="radio" name="maintype" value="dcmnrega">सम्बंधित उपायुक्त, श्रम रोजगार एवं नियोजन  </label>
 

<?php };?>
<?php if (Yii::$app->user->can('marktosqm')) {?>

  <label><input type="radio" name="maintype" value="sqm">सम्बंधित राज्य गुणवत्ता मॉनिटर</label>
<?php };?>
<?php if (Yii::$app->user->can('marktoothers')){ ?>
  <label><input type="radio" name="maintype" value="otherdesignation" onClick="$('#designation-select').toggle()" >Others</label>
<?php } ?>
</div>
<div id="designation-select" style="display:none">
<div id="form1">
<?= $form->field($modelComplaint,'marking[otherdesignation]')->widget(\app\modules\users\widgets\DesignationWidget::className())->label(false)?>
</div>
  <label><input type="radio" name="maintype" value="unregistered" onClick="$('#designation-id-select').toggle()" >Other than registered users</label>

<div id="form2">
<?= 
$form->field($modelComplaint,'marking[others][designation_type_id]')->dropDownList([DesignationType::otherTypes()])
//Designation::getDesignationByDistrict($district_code))
?>
<?= $form->field($modelComplaint,'marking[others][name]')->textInput(['class'=>'form-control hindiinput'])->label(Yii::t('app','Enquiry Officer'))?>
<?= $form->field($modelComplaint,'marking[others][mobileno]')->textInput()->label(Yii::t('app','Mobile No'.'of'.'Enquiry Officer'))?>

</div>
</div>
   <?= $form->field($modelComplaint,'marking[deadline]')->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
])->label(Yii::t('app','Deadline'))?>
<?php 
if (Yii::$app->user->can('complaintadmin') || Yii::$app->user->can('complaintagent')) 
  $actions=['a'=>Yii::t('app','For Action'),'e'=>Yii::t('app','For Enquiry')];
else
  $actions=['e'=>Yii::t('app','For Enquiry')];
$form->field($modelComplaint,'marking[actiontype]')->dropDownList($actions)->label('Action Type')?>
