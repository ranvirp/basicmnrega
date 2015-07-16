<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\MarkingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Markings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marking-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Marking</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

'request_type',['header'=>'request_id',
'attribute'=>'request_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('request_id');
},],['header'=>'sender',
'attribute'=>'sender',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('sender');
},],['header'=>'receiver',
'attribute'=>'receiver',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('receiver');
},],['header'=>'dateofmarking',
'attribute'=>'dateofmarking',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('dateofmarking');
},],             'deadline',
['header'=>'Status',
'attribute'=>'status',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('status');
},],
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'read_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-hover'],
        ]); ?>

</div>
</div>