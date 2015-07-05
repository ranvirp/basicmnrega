<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\PondSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ponds');
$this->params['breadcrumbs'][] = $this->title;
 \app\assets\AppAssetGoogle::register($this);
       
?>
<script>
$(document).ready(function(){$("input[name='PondSearch[name_hi]']").addClass('hindiinput');});
</script>
<div class="col-md-12">
<div class="pond-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Pond</span>
         <span class="well"><?= Html::a('New entry',\yii\helpers\Url::to(['/mnrega/pond/create']))?></span>

        </div>
    </div>
    <?php
     $district=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->level->code;
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'workid',
'attribute'=>'workid',
'value'=>function($model,$key,$index,$column)
{
                return Html::a($model->showValue('workid'),\yii\helpers\Url::to(['/mnrega/pond/photosbywork?workid='.$model->workid]));
},'format'=>'html'],['header'=>'Name',
'attribute'=>'name_hi',
],
['header'=>'Block',
'attribute'=>'block_code',
'filter'=>\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->where(['district_code'=>$district])->orderBy('name_en asc')->asArray()->all(),'code','name_en'),

'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('block_code');
},], 
'panchayat',
'totarea',
'estcost',
'persondays',
['header'=>'#photos',
'value'=>function($model,$key,$index,$column)
{
  return Html::a(\app\modules\gpsphoto\models\Photo::find()->where(['bwid'=>$model->workid])->count(),\yii\helpers\Url::to(['/mnrega/pond/photosbywork?workid='.$model->workid]));
},
'format'=>'html'
],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-striped'],
        ]); ?>

</div>
</div>