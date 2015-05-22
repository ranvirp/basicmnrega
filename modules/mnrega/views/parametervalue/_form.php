<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\ParameterValue */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_parameter-value").on("pjax:end", function() {
            $.pjax.reload({container:"#parameter-values"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form parameter-value-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating ParameterValue</span>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
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

    <?= $model->showForm($form,"parameter_id") ?>

    <?= $model->showForm($form,"district_id") ?>

    <?= $model->showForm($form,"parameter_value") ?>

    <?= $model->showForm($form,"update_time") ?>

<?php
/*
try {
$x= Utility::rules()["app\modules\mnrega\models\ParameterValue"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("ParameterValue");
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
