<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\Pjax;
use app\modules\complaint\models\ComplaintReply;
//app\assets\AppAssetGoogle::register($this);
?>
<?php 
$this->title = 'Add Reply';
?>
 <?php
 
 $this->registerJs(
   '
   $("document").ready(function(){ 
      $(".reply-form").on("submit", function(event) {
            //$.pjax.reload({container:"#complaint-list"});  //Reload GridView
            //$("#complaint-grid-view").yiiGridView("applyFilter");
            event.preventDefault(); // stop default submit behavior
    $.pjax.submit(event, "#complaint-action-div",{push:false,timeout:false});
            
        });
    });'
);

$markingid=$marking->id;

?>
<div class="form-title">
        <div class="form-title-span">
         <span>Reply for Complaint # <?= $id ?> and marking id <?=$markingid?></span>
        </div>
    </div>
<?php 
//Pjax::begin(['id'=>'reply-form','enablePushState'=>false]);

?>
<div class="col-md-12">
<?php
 $form = ActiveForm::begin([
 'options' => ['class'=>'reply-form' ],
 'enableClientScript' => true,
 'action'=>Url::to(['/complaint/complaint/filereply?id='.$id.'&markingid='.$markingid]),
     
 ]);
 ?>
 <?=$form->field($model,'reply')->textArea(['class'=>'hindiinput form-control','onclick'=>'js:hindiEnable()']) ?>
 <?=$form->field($model,'reply_type')->dropDownList(ComplaintReply::replyOptions($marking)) ?>
 
 
 <?=$form->field($model,'attachments')->widget(\app\modules\reply\widgets\FileWidget::className()) ?>
 <?php 
 if (Yii::$app->user->can('complaintagent')){
     $complaint = \app\modules\complaint\models\Complaint::findOne($id);
     if ($complaint)
     {
       echo Html::dropDownList('complaintstatus',$complaint->status,\app\modules\complaint\models\Complaint::statusNames(),['id'=>'complaintstatus','label'=>'Complaint Status','onchange'=>'$(\'#anchor1\').attr(\'href\','."'".Url::to(['/complaint/complaint/setstatus?id='.$id."&status="])."'+$('#complaintstatus').val()".')']);
       echo Html::a('Save without reply','#',['class'=>'reply-form','id'=>'anchor1','ajax'=>true]);
     }
 }
 ?>
 <?=Html::submitButton('Save',['class'=>'reply-form','onClick'=>'prevflag=1;'])?>
 <?php
 ActiveForm::end();
?>
</div>
<?php 
//Pjax::end();
?>
