 <?=\yii\helpers\Html::a($text,'#',['onclick'=>'populateHtml(\''.\yii\helpers\Url::to(['/complaint/complaint/mark?id='.$id.'&a='.$a.'&change='.$change]).'\',\'complaint-action-div\',\'refreshlink\');return false;'])?>