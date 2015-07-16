<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\JobcardDemand */
/* @var $form yii\widgets\ActiveForm */
use app\assets\AppAssetGoogle;
?>
<style>
div.required label:after {
    content: " *";
    color: red;
}
.panel-body
{
 padding:0px;
}
.item>.panel-body
{
 padding:5px;
}
</style>
<?php
 AppAssetGoogle::register($this);
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_jobcard-demand").on("pjax:end", function() {
            $.pjax.reload({container:"#jobcard-demands"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form jobcard-demand-form">
  <div class="form-title">
    <div class="form-title-span text-center">
        <h3>जॉबकार्ड की मांग करें</h3>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action'=>Url::to(['/complaint/jobcarddemand/create']),
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>
<div class="col-md-6">
    <?= $model->showForm($form,"name_hi") ?>

    <?= $model->showForm($form,"fname") ?>

    <?= $model->showForm($form,"mobileno") ?>

    <?= $model->showForm($form,"address") ?>

    <?= $model->showForm($form,"gender") ?>
</div>
<div class="col-md-6">
    <?= $model->showForm($form,"district_code") ?>

    <?= $model->showForm($form,"block_code") ?>

    <?= $model->showForm($form,"panchayat_code") ?>

    <?= $model->showForm($form,"village") ?>

</div>
<input type="hidden" name="maintype[]" value="po">
 <?=$form->field($model,'marking[deadline]')->hiddenInput(['id'=>'deadline'])->label(false)?>

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
