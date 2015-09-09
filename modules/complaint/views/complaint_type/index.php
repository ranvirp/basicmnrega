<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AppAssetGoogle;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\complaint\models\Complaint_typeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAssetGoogle::register($this);
$this->title = Yii::t('app', 'Complaint Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="complaint-type-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Complaint_type</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'shortcode',
'attribute'=>'shortcode',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('shortcode');
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
},],['header'=>'description',
'attribute'=>'description',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('description');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-striped small'],
        ]); ?>

</div>
</div>