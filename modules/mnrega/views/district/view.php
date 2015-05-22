<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\District */

$this->title = $model->district_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'district_code',
            'district_name',
        ],
    ]) ?>

</div>
