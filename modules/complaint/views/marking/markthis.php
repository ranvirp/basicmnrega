

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\ComplaintReply */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_complaint-reply").on("pjax:end", function() {
            $.pjax.reload({container:"#complaint-replys"});  //Reload GridView
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
    'layout' => 'horizontal',
    'action'=>Url::to(['/complaint/marking/markthis?id='.$id.'&markingid='.$markingid.'&a='.$a]),
	'options'=>['data-pjax'=>1],
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>

   
    <?= $form->field($model,"reply")->textArea(['class'=>'hindiinput form-control','onclick'=>'hindiEnable()']) ?>

    <?= $form->field($model,'attachments')->widget(\app\modules\reply\widgets\FileWidget::classname());
		 ?>

   
   
   

   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

