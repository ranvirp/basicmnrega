<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\mnrega\models\Pond */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
div.required label:after {
    content: " *";
    color: red;
}
</style>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_pond").on("pjax:end", function() {
            $.pjax.reload({container:"#ponds"});  //Reload GridView
        });
        $("#w1-btn").click(function(event){
        event.preventDefault();
        $("#block-name").val($("#pond-block_code option:selected").text());
        $("#panchayat-name").val($("#pond-panchayat option:selected").text());
        
        $("#w1").submit()})
    });'
);
?>
<div class="bordered-form pond-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>मुख्यमंत्री जल बचाओ अभियान के तहत लिए गए तालाब </span>
       
<span class="well"><?= Html::a('View List',\yii\helpers\Url::to(['/mnrega/pond/index'])) ?></span>
<?php echo $model->isNewRecord? '':"<span class=\"well\">".Html::a('New entry',\yii\helpers\Url::to(['/mnrega/pond/create']))."</span>";?>

    </div>
  </div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    //'action'=>Url::to(['/mnrega/pond/'.$model->isNewRecord?'create':'update?id='.$model->workid]),
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error'=>'',
            'hint'=>'',
        ],
    ],
]); ?>
<div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['id'=>'w1-btn','class' => $model->isNewRecord ? 'btn btn-success col-md-12' : 'btn btn-primary']) ?>
</div>
<div class="col-md-6">
    

    <?= $model->showForm($form,"block_code") ?>

    <?= $model->showForm($form,"panchayat_code") ?>

    <?= $model->showForm($form,"village") ?>
     <?= $model->showForm($form,"workid") ?>

    <?= $model->showForm($form,"name_hi") ?>
    <?= $model->showForm($form,"district_code") ?>
     <?= $model->showForm($form,"district") ?>
      <?= $model->showForm($form,"block") ?>
       <?= $model->showForm($form,"panchayat") ?>
</div>
<div class="col-md-6">

    <?= $model->showForm($form,"gatasankhya") ?>

    <?= $model->showForm($form,"totarea") ?>

    <?= $model->showForm($form,"estcost") ?>

    <?= $model->showForm($form,"persondays") ?>

    
    <?= $model->showForm($form,"status") ?>

    <?= $model->showForm($form,"remarks") ?>
</div>
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
?>    
    <?php ActiveForm::end(); ?>