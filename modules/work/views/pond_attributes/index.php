<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\work\models\PondAttributesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pond Attributes');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="pond-attributes-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of PondAttributes</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'workid',
'attribute'=>'workid',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('workid');
},],['header'=>'gatanumber',
'attribute'=>'gatanumber',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('gatanumber');
},],['header'=>'estpersondays',
'attribute'=>'estpersondays',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('estpersondays');
},],['header'=>'totalarea',
'attribute'=>'totalarea',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('totalarea');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>