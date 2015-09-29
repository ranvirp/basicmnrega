<div class="taxonomy-default-index">
   <?php
  // $mapping=['app\modules\documents\models\Document'=>['module'=>'docs','model'=>'document','pk'=>'id'],
   //];
    echo '<h2><strong> Articles related to '.$terms.'</strong></h2>';
    echo yii\widgets\ListView::widget([
'dataProvider'=>$dataProvider,
'itemView'=>function($model,$key,$index,$widget)
{
  
  
     $mapping=['app\modules\documents\models\Document'=>'/docs/document/view?id=',
      'app\modules\documents\models\Link'=>'/docs/link/view?id='
     ];
  
     $taggedClass=$model->taggedtype0->classname;
     //print_r($taggedClass);

     $url=$mapping[$taggedClass].$model->taggedtypepk;
     $taggedModel=$taggedClass::findOne($model->taggedtypepk);
        $title=$taggedModel->printTitle();
        return $taggedModel->shortview($this);
    // return \yii\helpers\Html::a($title,\yii\helpers\Url::to([$url]));
     
},]);
    ?>
</div>
