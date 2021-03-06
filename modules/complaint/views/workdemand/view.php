<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\mnrega\models\MarkingSearch;
use app\modules\complaint\models\WorkdemandReport;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\WorkDemand */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-demand-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if (!Yii::$app->user->isGuest) {?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>
<div class="col-md-6">
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
            ['attribute'=>'district_code','value'=>$model->district->name_en],
            ['attribute'=>'block_code','value'=>$model->block->name_en],
            ['attribute'=>'panchayat_code','value'=>$model->panchayat1->name_en],
            'village',
            'noofdays',
            'datefrom',
            'dateto',
            
        ],
    ]) ?>
    </div>
    <div class="col-md-6">
   <?php if ($report=WorkdemandReport::find()->where(['work_demand_id'=>$model->id])->one()) {?>
    <?= DetailView::widget([
        'model' => $report,
        'attributes' => [
            'id',
            ['header'=>'Work Given?',
            'attribute'=>'complainttrue',
            'value'=>$report->complainttrue?'Yes':'No',
            ],
            'description:text:Details',
            'work_id',
            'workname',
             
        ],
    ]) ?>
<?php } else print "Pending" ?>
</div>
</div>
<div class="row">
<?php
      $marking=new MarkingSearch;
      $marking->request_type='workdemand';
      $marking->request_id=$model->id;
      $dp =$marking->search([]);
      echo '<div class="col-sm-12">';
      print $this->render('@app/modules/mnrega/views/marking/index',['searchModel'=>$marking,'dataProvider'=>$dp,'markurl'=>null]);
       echo '</div>';
     
?>
</div>
