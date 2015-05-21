<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_requestform',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="request-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Request</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'id',
'attribute'=>'id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('id');
},],['header'=>'request_type_id',
'attribute'=>'request_type_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('request_type_id');
},],['header'=>'request_subject',
'attribute'=>'request_subject',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('request_subject');
},],['header'=>'content',
'attribute'=>'content',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('content');
},],['header'=>'attachments',
'attribute'=>'attachments',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('attachments');
},],            // 'author_id',
            // 'create_time:datetime',
            // 'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>