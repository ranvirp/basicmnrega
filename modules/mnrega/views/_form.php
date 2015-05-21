<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Marking */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_marking").on("pjax:end", function() {
            $.pjax.reload({container:"#markings"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form marking-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating Marking</span>
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

    <?= $model->showForm($form,"request_id") ?>

    <?= $model->showForm($form,"sender") ?>

    <?= $model->showForm($form,"receiver") ?>

    <?= $model->showForm($form,"dateofmarking") ?>

    <?= $model->showForm($form,"deadline") ?>

    <?= $model->showForm($form,"create_time") ?>

    <?= $model->showForm($form,"update_time") ?>

    <?= $model->showForm($form,"read_time") ?>

<?php
/*
try {
$x= Utility::rules()["app\modules\mnrega\models\Marking"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("Marking");
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
