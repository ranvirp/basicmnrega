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
.complaint-title
{
background-color: #3c6800;
    border-radius: 4px 4px 0 0;
    color: rgb(230, 230, 230);
    font-family: Arial,sans-serif;
    font-weight: normal;
    padding: 9px 3px 6px;
    margin-top:20px;
    }
    .complaint-title-span
    {
    margin-left:12px;
    font-size:20px;
    text-align:center;
    }
    
</style>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
      $("#w1-btn").click(function(event){
        event.preventDefault();
        $("#block-name").val($("#pond-block_code option:selected").text());
        $("#panchayat-name").val($("#pond-panchayat option:selected").text());
        
        $("#w0").submit()})  
    });'
);
?>
<div class="bordered-form pond-form">
  <div class="complaint-title">
    <div class="complaint-title-span">
        <span>कार्य की मांग</span>
       

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
            'error'=>'',
            'hint'=>'',
        ],
    ],
]); ?>
<div class="form-group col-md-12">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['id'=>'w1-btn','class' => 'btn btn-success']) ?>
    </div>
<div class="col-md-6">
    
 <?= $model->showForm($form,"district_code") ?>
   
    <?= $model->showForm($form,"block_code") ?>

    <?= $model->showForm($form,"panchayat_code") ?>

    <?= $model->showForm($form,"village") ?>
     <?= $model->showForm($form,"name") ?>
     <?= $model->showForm($form,"fname") ?>

    <?= $model->showForm($form,"fname") ?>
     <?= $model->showForm($form,"district") ?>
      <?= $model->showForm($form,"block") ?>
       <?= $model->showForm($form,"panchayat") ?>
</div>
<div class="col-md-6">

    <?= $model->showForm($form,"mobileno") ?>
     <?= $model->showForm($form,"jobcardno") ?>

    <?= $model->showForm($form,"noofdays") ?>

    <?= $model->showForm($form,"datefrom")->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'dd-MM-yyyy',
])  ?>

    <?= $model->showForm($form,"dateto")->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'dd-MM-yyyy',
]) ?>

    
    <?= $model->showForm($form,"workchoice") ?>

   
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

</div>
