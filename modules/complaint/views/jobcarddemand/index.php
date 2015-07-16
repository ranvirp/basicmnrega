<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\complaint\models\JobcardDemandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jobcard Demands');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="jobcard-demand-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of JobcardDemand</span>
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
},],['header'=>'name_hi',
'attribute'=>'name_hi',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('name_hi');
},],['header'=>'fname',
'attribute'=>'fname',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('fname');
},],['header'=>'mobileno',
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('mobileno');
},],['header'=>'address',
'attribute'=>'address',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('address');
},],            // 'gender',
            // 'district_code',
            // 'block_code',
            // 'panchayat_code',
            // 'village',
            // 'author',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'panchayat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>