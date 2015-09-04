<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\ComplaintReply */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Complaint Reply',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Complaint Replies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="complaint-reply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
