<div class="col-md-12">
<?=\yii\helpers\Html::textArea('reject-reason','',['id'=>'reject-reason'])?>
 <?=\yii\helpers\Html::a('Reject','#',['onclick'=>'$.post(\''.\yii\helpers\Url::to(['/complaint/marking/reject?markingid='.$markingid]).'\',{\'rejectreason\':$(\'#reject-reason\').val()};return false;'])?>
</div>