<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\formats\models\FormatValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Format Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="format-values-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of FormatValues</span>
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
},],['header'=>'format_id',
'attribute'=>'format_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('format_id');
},],['header'=>'created_by',
'attribute'=>'created_by',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('created_by');
},],['header'=>'finyear',
'attribute'=>'finyear',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('finyear');
},],['header'=>'scheme',
'attribute'=>'scheme',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('scheme');
},],            // 'district',
            // 'month',
            // 'values:ntext',
            // 'calcvalues:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-hover small'],
        ]); ?>

</div>
</div>