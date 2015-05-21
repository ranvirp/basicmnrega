<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\District */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'District',
]) . ' ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="district-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
