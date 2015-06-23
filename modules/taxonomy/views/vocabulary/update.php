<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\taxonomy\models\Vocabulary */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Vocabulary',
]) . ' ' . $model->vocabcode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vocabularies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vocabcode, 'url' => ['view', 'id' => $model->vocabcode]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vocabulary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
