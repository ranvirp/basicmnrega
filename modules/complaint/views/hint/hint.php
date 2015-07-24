<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\AppAssetGoogle;


/* @var $this yii\web\View */
/* @var $model app\modules\complaint\models\Complaint_marking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bordered-form complaint-marking-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for hints</span>
    </div>
</div>
    <?php
    AppAssetGoogle::register($this);
    $form = ActiveForm::begin([
    'layout' => 'horizontal',
    
]); ?>
<?php foreach ($hints as $name=>$value) { ?>
<?=Html::textInput('hint_names[]',$name,['class'=>'form-control'])?>
<?=Html::textInput('hint_values[]',$value,['class'=>'hindiinput form-control'])?>
<?php } ?>
   
<?php
/*
try {
$x= Utility::rules()["app\modules\complaint\models\Complaint_marking"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("Complaint_marking");
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
