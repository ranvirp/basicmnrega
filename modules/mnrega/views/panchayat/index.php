<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\PanchayatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Panchayats');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="panchayat-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Panchayat</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'district_code',
'attribute'=>'district_code',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('district_code');
},],['header'=>'block_code',
'attribute'=>'block_code',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('block_code');
},],['header'=>'code',
'attribute'=>'code',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('code');
},],['header'=>'name_hi',
'attribute'=>'name_hi',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('name_hi');
},],['header'=>'name_en',
'attribute'=>'name_en',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('name_en');
},],            // 'census_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>