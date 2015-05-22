<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\ParameterValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Parameter Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="parameter-value-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of ParameterValue</span>
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
},],['header'=>'parameter_value',
'attribute'=>'parameter_value',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('parameter_value');
},],['header'=>'update_time',
'attribute'=>'update_time',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('update_time');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>