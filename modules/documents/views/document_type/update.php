<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\documents\models\DocumentType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Document Type',
]) . ' ' . $model->shortcode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shortcode, 'url' => ['view', 'id' => $model->shortcode]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="document-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
