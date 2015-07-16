<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\WorkDemandSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-demand-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_hi') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'mobileno') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'jobcardno') ?>

    <?php // echo $form->field($model, 'district_code') ?>

    <?php // echo $form->field($model, 'block_code') ?>

    <?php // echo $form->field($model, 'panchayat_code') ?>

    <?php // echo $form->field($model, 'village') ?>

    <?php // echo $form->field($model, 'noofdays') ?>

    <?php // echo $form->field($model, 'datefrom') ?>

    <?php // echo $form->field($model, 'dateto') ?>

    <?php // echo $form->field($model, 'workchoice') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
