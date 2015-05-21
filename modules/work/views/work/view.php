<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\Work */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'workid',
            'name_hi',
            'name_en',
            'description:ntext',
            'agency_id',
            'work_type_id',
            'totvalue',
            'scheme_id',
            'district_id',
            'address',
            'gpslat',
            'gpslong',
            'work_admin',
            'block_code',
            'panchayat_code',
            'village_code',
            'status',
            'remarks:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
