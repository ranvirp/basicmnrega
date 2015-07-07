<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Request */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-view">

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
            'request_type_id',
            'request_subject',
            'content:ntext',
            'attachments:ntext',
            'author_id',
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]) ?>
<p>Marked To:</p>
<hl>
<table class="table table-hover">
<tr>
   <th>From</th>
   <th>To</th>
   <th>Date of Marking</th>
   <th>Deadline</th>
   <th>Status</th>
</tr>
<?php
foreach ($model->markings as $marking)
{
  echo '<tr><td>'.$marking->sender1->name_en.'</td><td>'.$marking->receiver1->name_en.'</td><td>'.$marking->dateofmarking.'</td><td>'.$marking->deadline.'</td><td>'.$marking->status.'</td><td>'.Html::a('Reply',Url::to(['/reply/default/create?ct=marking&ctid=']).$marking->id).'</td></tr>';

}

?>
</table>
</div>
