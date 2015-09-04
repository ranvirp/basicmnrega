<div class="col-md-12">
 <?=\yii\helpers\Html::a($text,'#',['onclick'=>'populateHtml(\''.\yii\helpers\Url::to(['/complaint/marking/review?id='.$id.'&markingid='.$marking->id.'&accept=0']).'\',\'complaint-action-div\');return false;'])?>
</div>