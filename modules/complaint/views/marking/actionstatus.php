 <?=\yii\helpers\Html::a($text,'#',['onclick'=>'populateHtml(\''.\yii\helpers\Url::to(['/complaint/complaint/setstatus?status='.$status.'&id='.$id]).'\',\'complaint-status-div\');return false;'])?>
