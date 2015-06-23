<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\taxonomy\models\TermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Terms');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="term-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Term</span>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

['header'=>'termcode',
'attribute'=>'termcode',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('termcode');
},],['header'=>'vocabcode',
'attribute'=>'vocabcode',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('vocabcode');
},],['header'=>'termname',
'attribute'=>'termname',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('termname');
},],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-bordered small'],
        ]); ?>

</div>
</div>