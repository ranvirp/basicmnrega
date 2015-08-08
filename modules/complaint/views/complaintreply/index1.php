<?php
\yii\widgets\Pjax::begin(['id'=>'reply-list','enablePushState'=>false,'timeout'=>false]);
echo \yii\grid\GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel'=>$searchModel,
  'columns'=>[
    [
    'header'=>Yii::t('app','Action Taken'),
    'attribute'=>'reply_type',
    'value'=>function($model,$key,$index)
    {
      return $this->render('../complaint/_complaintreply',['model'=>$model]);
    },
    'format'=>'html',
    'filter'=>\app\modules\complaint\models\ComplaintReply::types(),
    ],
  ],
]);
\yii\widgets\Pjax::end();
?>