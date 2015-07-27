<?php
use app\assets\AppAssetGoogle;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\modules\complaint\models\ComplaintReply;
?>
<?php 
$this->title = 'Add Reply';
?>
 <?php
 $this->registerJs(
   'flag=0;
   $("document").ready(function(){ 
      $(".reply-form").on("submit", function() {
            //$.pjax.reload({container:"#complaint-list"});  //Reload GridView
            $("#complaint-grid-view").yiiGridView("applyFilter");
        });
    });'
);
?>
<div class="form-title">
        <div class="form-title-span">
         <span>Reply for Complaint # <?= $id ?></span>
        </div>
    </div>
<?php 
//Pjax::begin(['id'=>'reply-form','enablePushState'=>false]);

?>
<div class="col-md-12">
<?php

 $form = ActiveForm::begin([
 'options' => ['data-pjax' => 1,'class'=>'reply-form' ],
 'enableClientScript' => true,
 'action'=>Url::to(['/complaint/complaint/filereply?id='.$id.'&markingid='.$markingid]),
     
 ]);
 ?>
 <?=$form->field($model,'reply')->textArea(['class'=>'hindiinput form-control','onclick'=>'js:hindiEnable()']) ?>
 <?=$form->field($model,'reply_type')->dropDownList(ComplaintReply::types()) ?>
 
 <?=$form->field($model,'attachments')->widget(\app\modules\reply\widgets\FileWidget::className()) ?>
 
 <?=Html::submitButton('Save',['class'=>'reply-form','onClick'=>'flag=1'])?>
 <?php
 ActiveForm::end();
?>
</div>
<?php 
//Pjax::end();
?>
