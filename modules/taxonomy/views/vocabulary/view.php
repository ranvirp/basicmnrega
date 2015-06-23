<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\taxonomy\models\Vocabulary */

$this->title = $model->vocabcode;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vocabularies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vocabulary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->vocabcode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->vocabcode], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'vocabcode',
            'vocabname',
        ],
    ]) ?>

</div>
