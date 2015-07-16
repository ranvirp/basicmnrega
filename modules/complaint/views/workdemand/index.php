<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Work Demands');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="work-demand-index">



    <div class="form-title">
        <div class="form-title-span">
         <span>List of WorkDemand</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
},],['header'=>'gender',
'attribute'=>'gender',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('gender');
},],['header'=>'mobileno',
'attribute'=>'mobileno',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('mobileno');
},],            // 'address:ntext',
            // 'jobcardno',
            // 'district_code',
            // 'block_code',
            // 'panchayat_code',
            // 'village',
            // 'noofdays',
            // 'datefrom',
            // 'dateto',
            // 'workchoice:ntext',
            // 'author',
            // 'create_time:datetime',
            // 'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>