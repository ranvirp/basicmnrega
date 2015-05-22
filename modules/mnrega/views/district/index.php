<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Districts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
<div class="district-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of District</span>
        </div>
    </div>
    <?php 
    $dataProvider->setSort(['attributes'=>['district_code','district_name']]);
    ?>
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
},],['header'=>'district_name',
'attribute'=>'district_name',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('district_name');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small table table-striped'],
        ]); ?>

</div>
</div>