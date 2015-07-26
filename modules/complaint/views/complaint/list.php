
<div class="container-fluid">
<?php
$count=0;
$items=[];
foreach ($replies->all() as $reply)
{
    $x=[];
	$x['header']='Reply #'.($count+1);
	//$x['content']= $reply->reply;
	$x['content']= $this->render('_reply',['reply'=>$reply]);
	$items[]=$x;
	$count++;
}
echo \yii\jui\Accordion::widget([
    'items' => $items,
     'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['tag' => 'h3'],
    'clientOptions' => ['collapsible' => false],
    
]);
?>
</div>

