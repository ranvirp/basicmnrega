<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\RequestTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Request Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="request-type-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of RequestType</span>
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
},],['header'=>'category',
'attribute'=>'category',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('category');
},],['header'=>'name',
'attribute'=>'name',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('name');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>