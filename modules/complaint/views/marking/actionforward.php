<div class="col-md-12">
 <?=\yii\helpers\Html::a('Forward','#',['onclick'=>'populateHtml(\''.\yii\helpers\Url::to(['/complaint/marking/forward?id='.$id.'&markingid='.$markingid.'&newmarkingid='.$newmarkingid]).'\',\'complaint-action-div\');return false;'])?>
</div>