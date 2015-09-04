<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\ComplaintReplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complaint-reply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'marking_id') ?>

    <?= $form->field($model, 'reply') ?>

    <?= $form->field($model, 'attachments') ?>

    <?= $form->field($model, 'reply_type') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'accepted') ?>

    <?php // echo $form->field($model, 'complaint_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
