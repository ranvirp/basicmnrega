
<?php
$count=0;
$items=[];
foreach ($replies->orderBy('created_at desc')->all() as $reply)
{
    $x=[];
	$x['header']='<small>Reply #'.($count+1).'</small>';
	//$x['content']= $reply->reply;
	$x['content']= $this->render('_reply',['reply'=>$reply]);
	$items[]=$x;
	$count++;
}
echo \yii\jui\Accordion::widget([
    'items' => $items,
     'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
   // 'headerOptions' => ['tag' => 'h3'],
    'clientOptions' => ['collapsible' => false],
    
]);
?>


