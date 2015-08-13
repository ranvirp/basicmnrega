<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;


/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\ComplaintReply */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
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
?>
<div class="bordered-form complaint-reply-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating ComplaintReply</span>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    
    'action'=>Url::to(['/complaint/marking/markthis?id='.$id.'&markingid='.$markingid.'&a='.$a]),
	'options'=>['class'=>'reply-form'],
	'enableClientScript' => true,
  
]); ?>

   
    <?= $form->field($model,"reply")->textArea(['class'=>'hindiinput form-control','onclick'=>'hindiEnable()']) ?>

    <?= $form->field($model,'attachments')->widget(\app\modules\reply\widgets\FileWidget::classname());
		 ?>

   
   
   

   <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create') , ['class' => 'btn btn-success reply-form' ,'onClick'=>'']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

