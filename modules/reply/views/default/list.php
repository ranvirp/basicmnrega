<?php

//get all replies related to a reply 
$classmap =array_flip(\app\modules\reply\models\Reply::$classmap);
$replies = \app\modules\reply\models\Reply::find()->where(['content_type'=>$classmap[get_class($model)],
	'content_type_id'=>$model->id])->orderBy("create_time desc")->all();
	?>
<div class="container-fluid">
<?php
$count=0;
$items=[];
foreach ($replies as $reply)
{
	$items[$count]['header']='Reply #'.($count+1);
	$items[$count]['content']= $this->render('_reply',['reply'=>$reply]);
	$count++;
}
echo \yii\jui\Accordion::widget([
    'items' => $items,
    
]);
?>
</div>

