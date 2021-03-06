<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\PanchayatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panchayat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'district_code') ?>

    <?= $form->field($model, 'block_code') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name_hi') ?>

    <?= $form->field($model, 'name_en') ?>

    <?php // echo $form->field($model, 'census_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
