<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\ParameterTargetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Parameter Targets');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="parameter-target-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of ParameterTarget</span>
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
},],['header'=>'parameter_id',
'attribute'=>'parameter_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('parameter_id');
},],['header'=>'district_id',
'attribute'=>'district_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('district_id');
},],['header'=>'parameter_target',
'attribute'=>'parameter_target',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('parameter_target');
},],['header'=>'month',
'attribute'=>'month',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('month');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>