<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\work\models\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Works');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model,'attributeForm'=>$attributeForm,'attributeModel'=>$attributeModel]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="work-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Work</span>
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
},],['header'=>'uniqueid',
'attribute'=>'uniqueid',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('uniqueid');
},],['header'=>'workid',
'attribute'=>'workid',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('workid');
},],['header'=>'name_hi',
'attribute'=>'name_hi',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('name_hi');
},],
    // 'description:ntext',
            // 'agency_code',
            // 'work_type_code',
            // 'estcost',
            // 'scheme_code',
            // 'district_code',
            // 'block_code',
            // 'panchayat_code',
            // 'village_code',
             'district',
             'block',
             'panchayat',
            // 'village',
            // 'division_code',
            // 'address',
            // 'gpslat',
            // 'gpslong',
            // 'work_admin',
             'status',
            // 'remarks:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-bordered small'],
        ]); ?>

</div>
</div>