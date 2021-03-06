<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\PondAttributes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pond Attributes',
]) . ' ' . $model->workid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pond Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->workid, 'url' => ['view', 'id' => $model->workid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pond-attributes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
