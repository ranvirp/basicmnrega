<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\Complaint_subtype */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Complaint Subtype',
]) . ' ' . $model->shortcode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Subtypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shortcode, 'url' => ['view', 'id' => $model->shortcode]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="complaint-subtype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
