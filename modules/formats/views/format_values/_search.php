<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\formats\models\FormatValuesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="format-values-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'format_id') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'finyear') ?>

    <?= $form->field($model, 'scheme') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'month') ?>

    <?php // echo $form->field($model, 'values') ?>

    <?php // echo $form->field($model, 'calcvalues') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
