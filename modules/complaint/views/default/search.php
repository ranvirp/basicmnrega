<style>
.top-offset
{
margin-top:12px;
}
</style>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'search-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="row">
<div class="col-md-4 col-sm-4">
<?php 
$types=['complaint'=>Yii::t('app','Complaint'),
        'workdemand'=>Yii::t('app','Work Demand'),
        'jobcarddemand'=>Yii::t('app','Jobcarddemand'),
       ];

?>
    <?= $form->field($model, 'type')->dropDownList($types) ?>
</div>
<div class="col-md-1"></div>
<div class="col-md-4 col-sm-4">

    <?= $form->field($model, 'id')->textInput()?>
</div>
<div class="col-md-1">
</div>
<div class="col-md-12">
   <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(),['captchaAction' => '/site/captcha'])?>
</div>
<div class="col-md-3 col-sm-3 top-offset">
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary top-offset']) ?>
        </div>
    </div>
</div>
    </div>
<?php ActiveForm::end() ?>