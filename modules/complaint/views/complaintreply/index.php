<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\complaint\models\ComplaintReplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Complaint Replies');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($model!=null):?><div class="col-md-6">
<?=$this->render('_form',['model'=>$model]) ?></div>
<div class="col-md-6">
<?php else:?><div class="col-md-12">
<?php endif;?><div class="complaint-reply-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="form-title">
        <div class="form-title-span">
         <span>List of ComplaintReply</span>
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
},],['header'=>'marking_id',
'attribute'=>'marking_id',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('marking_id');
},],['header'=>'reply',
'attribute'=>'reply',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('reply');
},],['header'=>'attachments',
'attribute'=>'attachments',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('attachments');
},],['header'=>'reply_type',
'attribute'=>'reply_type',
'value'=>function($model,$key,$index,$column)
{
                return $model->showValue('reply_type');
},],            // 'created_at',
            // 'updated_at',
            // 'author',
            // 'accepted',
            // 'complaint_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions'=>['class'=>'small'],
        ]); ?>

</div>
</div>