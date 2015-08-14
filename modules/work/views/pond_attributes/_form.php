<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\PondAttributes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bordered-form pond-attributes-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Other Attributes of Pond </span>
    </div>
</div>


   
    <?= $model->showForm($form,"gatanumber") ?>

    <?= $model->showForm($form,"estpersondays") ?>

    <?= $model->showForm($form,"totalarea") ?>



   

</div>
