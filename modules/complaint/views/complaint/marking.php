<?php
use yii\widgets\ActiveForm;
use app\modules\users\models\DesignationType;
\app\assets\AppAssetGoogle::register($this);
?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form','options'=>['data-pjax'=>1]]); ?>
  <div class="col-md-12"><span>Mark to Officer</span></div> 
<?php if (Yii::$app->user->can('marktopo')) {?>
            <div class="checkbox">
  <label><input type="checkbox" name="maintype[]" value="po" checked>सम्बंधित खंड विकास अधिकारी</label>
<?php };?>
<?php if (Yii::$app->user->can('marktosqm')) {?>

  <label><input type="checkbox" name="maintype[]" value="sqm">सम्बंधित राज्य गुणवत्ता मॉनिटर</label>
<?php };?>
<?php if (Yii::$app->user->can('marktoothers')){ ?>
  <label><input type="checkbox" name="" onClick="$('#designation-select').toggle()" >Others</label>
<?php } ?>
</div>
<div id="designation-select" style="display:none">
<div id="form1">
<?= $form->field($modelComplaint,'marking[others][designation][]')->widget(\app\modules\users\widgets\DesignationWidget::className())->label(false)?>
</div>
</div>
  <label><input type="checkbox" name="" onClick="$('#designation-id-select').toggle()" >Other than registered users</label>

<div id="designation-id-select" style="display:none">
<div id="form2">
<?= $form->field($modelComplaint,'marking[others][designation_type_id]')->dropDownList(\yii\helpers\ArrayHelper::map(DesignationType::find()->asArray()->all(),'id','name_en'))->label('Designation Type')
//Designation::getDesignationByDistrict($district_code))
?>
<?= $form->field($modelComplaint,'marking[others][name]')->textInput(['class'=>'form-control hindiinput'])->label(Yii::t('app','Enquiry Officer'))?>
<?= $form->field($modelComplaint,'marking[others][mobileno]')->textInput()->label(Yii::t('app','Mobile No'.'of'.'Enquiry Officer'))?>

</div>
</div>
   <?= $form->field($modelComplaint,'marking[deadline]')->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
])->label(Yii::t('app','Deadline'))?>

 <div class="form-group">
        <?= \yii\helpers\Html::submitButton($modelComplaint->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>