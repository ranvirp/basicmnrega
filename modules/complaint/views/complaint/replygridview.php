
<?php
\yii\widgets\Pjax::begin(['id'=>'reply-list','enablePushState'=>false,'timeout'=>false]);
echo \yii\grid\GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel'=>$searchModel,
  'filterUrl'=>['/complaint/complaintreply/index?id='.$searchModel->complaint_id],
  'columns'=>[
   [
   'attribute'=>'complaint_id',
  'visible'=>false,
   //'filter'=>true,
   ],
    [
    'header'=>Yii::t('app','Action Taken'),
    'attribute'=>'reply_type',
    'value'=>function($model,$key,$index)
    {
      return $this->render('_complaintreply',['model'=>$model]);
    },
    'format'=>'html',
    'filter'=>\app\modules\complaint\models\ComplaintReply::types(),
    ],
  ],
]);
\yii\widgets\Pjax::end();
?>