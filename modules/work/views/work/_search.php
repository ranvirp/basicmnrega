<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\WorkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uniqueid') ?>

    <?= $form->field($model, 'workid') ?>

    <?= $form->field($model, 'name_hi') ?>

    <?= $form->field($model, 'name_en') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'agency_code') ?>

    <?php // echo $form->field($model, 'work_type_code') ?>

    <?php // echo $form->field($model, 'estcost') ?>

    <?php // echo $form->field($model, 'scheme_code') ?>

    <?php // echo $form->field($model, 'district_code') ?>

    <?php // echo $form->field($model, 'block_code') ?>

    <?php // echo $form->field($model, 'panchayat_code') ?>

    <?php // echo $form->field($model, 'village_code') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'block') ?>

    <?php // echo $form->field($model, 'panchayat') ?>

    <?php // echo $form->field($model, 'village') ?>

    <?php // echo $form->field($model, 'division_code') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'gpslat') ?>

    <?php // echo $form->field($model, 'gpslong') ?>

    <?php // echo $form->field($model, 'work_admin') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
