<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\Complaint_type */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Complaint Type',
]) . ' ' . $model->shortcode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shortcode, 'url' => ['view', 'id' => $model->shortcode]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="complaint-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
