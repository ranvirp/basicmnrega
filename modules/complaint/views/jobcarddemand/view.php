<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\mnrega\models\MarkingSearch;
use app\modules\complaint\models\JobcarddemandReport;
/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\JobcardDemand */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobcard Demands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobcard-demand-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_hi',
            'fname',
            'mobileno',
            'address:ntext',
            'gender',
            'district_code:text:'.$model->showValue('district_code'),
            'block_code',
            'panchayat_code',
            'village',
           
            'panchayat',
        ],
    ]) ?>
    <?php if ($report=JobcarddemandReport::find()->where(['jobcarddemand_id'=>$model->id])->one()) {?>
    <?= DetailView::widget([
        'model' => $report,
        'attributes' => [
         ['header'=>'Job Card Given?',
            'attribute'=>'complainttrue',
            'value'=>$report->complainttrue?'Yes':'No',
            ],
            'jobcardno',
            'datefrom'
             
        ],
    ]) ?>
<?php } ?>

</div>
<div class="row">
<?php
      $marking=new MarkingSearch;
      $marking->request_type='jobcarddemand';
      $marking->request_id=$model->id;
      $dp =$marking->search([]);
      echo '<div class="col-sm-8">';
      print $this->render('@app/modules/mnrega/views/marking/index',['searchModel'=>$marking,'dataProvider'=>$dp,'markurl'=>null]);
       echo '</div>';
     
?>
</div>
