<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\PondSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pond-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'workid') ?>

    <?= $form->field($model, 'name_hi') ?>

    <?= $form->field($model, 'name_en') ?>

    <?= $form->field($model, 'district_code') ?>

    <?= $form->field($model, 'block_code') ?>

    <?php // echo $form->field($model, 'panchayat_code') ?>

    <?php // echo $form->field($model, 'village') ?>

    <?php // echo $form->field($model, 'gatasankhya') ?>

    <?php // echo $form->field($model, 'totarea') ?>

    <?php // echo $form->field($model, 'estcost') ?>

    <?php // echo $form->field($model, 'persondays') ?>

    <?php // echo $form->field($model, 'gpslat') ?>

    <?php // echo $form->field($model, 'gpslong') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
