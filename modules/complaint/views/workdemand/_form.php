<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\WorkDemand */
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
        $("#new_work-demand").on("pjax:end", function() {
            $.pjax.reload({container:"#work-demands"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form work-demand-form">
  <div class="form-title">
    <div class="form-title-span text-center">
        <h3>कार्य की मांग दर्ज करें</h3>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action'=>Url::to(['/complaint/workdemand/create']),
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
<div class="row">
<div class="col-md-6">
    <?= $model->showForm($form,"name_hi") ?>

    <?= $model->showForm($form,"fname") ?>

    <?= $model->showForm($form,"gender") ?>

    <?= $model->showForm($form,"mobileno") ?>

    <?= $model->showForm($form,"address") ?>

    <?= $model->showForm($form,"jobcardno") ?>
  
    <?= $model->showForm($form,"workchoice") ?>

</div>
<div class="col-md-6">
    <?= $model->showForm($form,"district_code") ?>

    <?= $model->showForm($form,"block_code") ?>

    <?= $model->showForm($form,"panchayat_code") ?>
    <?= $model->showForm($form,"panchayat") ?>


    <?= $model->showForm($form,"village") ?>

   
   </div>
   </div>
     <div class="row">
 <div class="col-md-6">
   <?= $model->showForm($form,"noofdays") ?>
 </div>

 <div class="col-md-3">
    <?= $model->showForm($form,"datefrom") ?>
</div>
<div class="col-md-3">
    <?= $model->showForm($form,"dateto") ?>
</div>
 <input type="hidden" name="maintype[]" value="po">
 <?=$form->field($model,'marking[deadline]')->hiddenInput(['id'=>'deadline'])->label(false)?>
</div>
   <div class="row">
   <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
