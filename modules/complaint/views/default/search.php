<style>
.top-offset
{
margin-top:12px;
}

</style>
<div class="simple-box">

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = ActiveForm::begin([
    'id' => 'search-form',
    'options' => ['class' => 'form-horizontal'],
    'action'=>\yii\helpers\Url::to(['/complaint/default/search']),
    
]) ?>
<div class="row">
<div class="col-md-12">
<h2 class="top-offset"><strong>कृपया शिकायत/मांगों की अद्यतन स्थिति यहाँ से ज्ञात करें:</strong></h2>
</div>
<div class="col-md-4 col-sm-4 centered">
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
<div class="col-md-12">
</div>
<div class="col-md-offset-5 col-md-2">
   <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(),['captchaAction' => '/site/captcha'])?>
</div>
<div class="col-md-12">
</div>
<div class="centered col-md-4 col-sm-4">
    <div class="form-group">
        <div class="col-lg-offset-5 col-lg-11">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary form-control']) ?>
        </div>
    </div>
</div>
    </div>
<?php ActiveForm::end() ?>
</div>
