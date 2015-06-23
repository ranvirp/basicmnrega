<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Pond */

$this->title = $model->workid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ponds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pond-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->workid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->workid], [
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
            'workid',
            'name_hi',
            'name_en',
            'district_code',
            'block_code',
            'panchayat_code',
            'village',
            'gatasankhya',
            'totarea',
            'estcost',
            'persondays',
            'gpslat',
            'gpslong',
            'status',
            'remarks:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
