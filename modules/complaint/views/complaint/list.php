
<div class="container-fluid">
<?php
$count=0;
$items=[];
foreach ($replies->all() as $reply)
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

