<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_request").on("pjax:end", function() {
            $.pjax.reload({container:"#requests"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form request-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating Request</span>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
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

    <?= $model->showForm($form,"request_type_id") ?>

    <?= $model->showForm($form,"request_subject") ?>

    <?= $model->showForm($form,"request_content") ?>

    <?= $model->showForm($form,"attachments") ?>
    <?= $model->showForm($form,"marking_to") ?>
    <?= $model->showForm($form,"deadline") ?>

   
   <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create') , ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
