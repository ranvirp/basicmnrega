<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\ParameterValue */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Parameter Value',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parameter Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="parameter-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
