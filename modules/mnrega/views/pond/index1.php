<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mnrega\models\PondSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ponds');
$this->params['breadcrumbs'][] = $this->title;
 \app\assets\AppAssetGoogle::register($this);
       
?>

<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="pond-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'workid',
'attribute'=>'workid',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('workid');
},],['header'=>'Name',
'attribute'=>'name_hi',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('name_hi');
},],'district','block',
'panchayat',
            'village',
            'gatasankhya',
             'totarea',
            'estcost',
            'persondays',
            //'gpslat',
            // 'gpslong',
            ['header'=>'Status',
'attribute'=>'status',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('status');
},],
            // 'remarks:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small table table-striped'],
        ]); ?>

</div>
</div>
</div>