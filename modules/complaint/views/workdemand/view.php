<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\WorkDemand */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-demand-view">

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
            'name_hi',
            'fname',
            'gender',
            'mobileno',
            'address:ntext',
            'jobcardno',
            'district_code',
            'block_code',
            'panchayat_code',
            'village',
            'noofdays',
            'datefrom',
            'dateto',
            'workchoice:ntext',
            'author',
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]) ?>

</div>