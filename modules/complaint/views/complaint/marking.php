<?php
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
   
<?php if (Yii::$app->user->can('marktopo')) {?>
 <p> Marked to </p><hl>
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
<?= $form->field($modelComplaint,'marking[designation][]')->widget(\app\modules\users\widgets\DesignationWidget::className())->label(false)?>
</div>
   <?= $form->field($modelComplaint,'marking[deadline]')->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
])?>
</div>
 <div class="form-group">
        <?= Html::submitButton($modelComplaintPoint->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>