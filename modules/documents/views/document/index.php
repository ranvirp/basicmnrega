<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\documents\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="document-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of Document</span>
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
},],['header'=>'document_type',
'attribute'=>'document_type',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('document_type');
},],['header'=>'document_subtype',
'attribute'=>'document_subtype',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('document_subtype');
},],['header'=>'description',
'attribute'=>'description',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('description');
},],            // 'shorttext:ntext',
            // 'fulltext:ntext',
            // 'attachments:ntext',
            // 'gallery:ntext',
            // 'author',
            // 'status',
            // 'create_time:datetime',
            // 'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'table table-hover small'],
        ]); ?>

</div>
</div>