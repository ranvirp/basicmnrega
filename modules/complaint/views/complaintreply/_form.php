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
    'action'=>Url::to(['/ComplaintReply/create']),
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

    <?= $model->showForm($form,"marking_id") ?>

    <?= $model->showForm($form,"reply") ?>

    <?= $model->showForm($form,"attachments") ?>

    <?= $model->showForm($form,"reply_type") ?>

    <?= $model->showForm($form,"created_at") ?>

    <?= $model->showForm($form,"updated_at") ?>

    <?= $model->showForm($form,"author") ?>

    <?= $model->showForm($form,"complaint_id") ?>

<?php
/*
try {
$x= Utility::rules()["app\modules\complaint\models\ComplaintReply"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("ComplaintReply");
		if ($x && $model && array_key_exists($changeattribute,$modelArray) && array_key_exists($modelArray[$changeattribute],$x))
		{
			$attribute_value=$modelArray[$changeattribute];
			
			foreach ($x[$attribute_value]["show"] as $field)
			{
			  
				echo "<div class=\"row\">\n";
			
				echo $model->showForm($form,$field);
				echo "</div>";
			
			}
		}
**/
?>    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
