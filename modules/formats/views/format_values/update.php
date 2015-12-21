<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\formats\models\FormatValues */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Format Values',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Format Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="format-values-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
