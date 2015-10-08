<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\work\models\WorkRatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Work Ratings');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="work-rating-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of WorkRating</span>
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
},],['header'=>'work_id',
'attribute'=>'work_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('work_id');
},],['header'=>'rating',
'attribute'=>'rating',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('rating');
},],['header'=>'rating_by',
'attribute'=>'rating_by',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('rating_by');
},],['header'=>'rating_at',
'attribute'=>'rating_at',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('rating_at');
},],            // 'rating_comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>