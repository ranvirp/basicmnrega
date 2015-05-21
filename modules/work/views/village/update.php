<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\Village */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Village',
]) . ' ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Villages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="village-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
