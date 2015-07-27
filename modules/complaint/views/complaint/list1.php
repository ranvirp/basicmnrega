
<div class="container-fluid">
<?php
$count=0;
$items=[];
/*
foreach ($replies->all() as $reply)
{
    $x=[];
	$x['header']='Reply #'.($count+1);
	//$x['content']= $reply->reply;
	$x['content']= $this->render('_reply',['reply'=>$reply]);
	$items[]=$x;
	$count++;
}
*/
foreach ($replies->orderBy('created_at desc')->all() as $reply)
{
$x=[];
 $x['header']=$reply->id;
 $x['content']='';
 $items[]=$x;
}
echo \yii\jui\Accordion::widget([
    'items' => $items,
     'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['tag' => 'h3'],
    'clientOptions' => [
       'collapsible' => false,
      'changestart' => "function(event, ui) {
            if (ui.newContent.is(':empty')) {
                \$(ui.newContent).load('".\yii\helpers\Url::to(['/complaint/complaint/getreply?id='])."' + escape(ui.newHeader.text()));
            }
        }",
        'change'=> "function() {
            \$accordion.accordion('resize');
        }"]
    
]);
?>
</div>

