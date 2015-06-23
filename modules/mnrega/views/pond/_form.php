<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Pond */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_pond").on("pjax:end", function() {
            $.pjax.reload({container:"#ponds"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form pond-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating Pond</span>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action'=>Url::to(['/Pond/create']),
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

    <?= $model->showForm($form,"workid") ?>

    <?= $model->showForm($form,"name_hi") ?>

    <?= $model->showForm($form,"name_en") ?>

    <?= $model->showForm($form,"district_code") ?>

    <?= $model->showForm($form,"block_code") ?>

    <?= $model->showForm($form,"panchayat_code") ?>

    <?= $model->showForm($form,"village") ?>

    <?= $model->showForm($form,"gatasankhya") ?>

    <?= $model->showForm($form,"totarea") ?>

    <?= $model->showForm($form,"estcost") ?>

    <?= $model->showForm($form,"persondays") ?>

    <?= $model->showForm($form,"gpslat") ?>

    <?= $model->showForm($form,"gpslong") ?>

    <?= $model->showForm($form,"status") ?>

    <?= $model->showForm($form,"remarks") ?>

    <?= $model->showForm($form,"created_at") ?>

    <?= $model->showForm($form,"updated_at") ?>

    <?= $model->showForm($form,"created_by") ?>

    <?= $model->showForm($form,"updated_by") ?>

<?php
/*
try {
$x= Utility::rules()["app\modules\mnrega\models\Pond"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("Pond");
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
