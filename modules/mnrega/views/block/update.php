<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Block */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Block',
]) . ' ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="block-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
