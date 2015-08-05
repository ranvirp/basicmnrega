<div class="col-md-12">
 <?=\yii\helpers\Html::a('Accept and Forward','#',['onclick'=>'populateHtml(\''.\yii\helpers\Url::to(['/complaint/marking/forward?id='.$id.'&markingid='.$markingid.'&newmarkingid='.$newmarkingid.'&reaccept=1']).'\',\'complaint-action-div\');return false;'])?>
</div>