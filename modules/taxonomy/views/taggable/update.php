<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\taxonomy\models\Taggable */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Taggable',
]) . ' ' . $model->shortname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taggables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shortname, 'url' => ['view', 'id' => $model->shortname]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="taggable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
