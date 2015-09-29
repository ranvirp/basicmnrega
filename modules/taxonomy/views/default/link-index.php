<div class="taxonomy-default-index">
   <?php
   use app\modules\documents\models\Link;
   use yii\helpers\Html;
  // $mapping=['app\modules\documents\models\Document'=>['module'=>'docs','model'=>'document','pk'=>'id'],
   //];
   echo '<h2> <strong>Files/Links related to '.$terms.'</strong></h2>';
    echo yii\grid\GridView::widget([
'dataProvider'=>$dataProvider,
'columns'=>[
['header'=>'Date',
 'value'=>function($model,$key,$index){
  $link= Link::findOne($model->taggedtypepk);
  return $link->dateofurl;

 }
 ],
 ['header'=>'File',
 'value'=>function($model,$key,$index){
    $link= Link::findOne($model->taggedtypepk);
  return Html::a($link->name_hi,$link->url);


 },
 'format'=>'html'
 ],
],
]);
    ?>
</div>
