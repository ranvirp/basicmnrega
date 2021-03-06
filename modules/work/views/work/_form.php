<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\common\Utility;

/* @var $this yii\web\View */
/* @var $model app\modules\work\models\Work */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 
 $changeattribute='';
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_work").on("pjax:end", function() {
            $.pjax.reload({container:"#works"});  //Reload GridView
        });
    });'
);
?>
<div class="bordered-form work-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating Work</span>
    </div>
</div>
    <?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'action'=>Url::to(['/work/work/create?type='.$model->work_type_code]),
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
<div class="col-md-6">
 <p> Work Type : <?=$model->work_type_code ?> </p>
 <?= $model->showForm($form,"scheme_code") ?>

  <?= $model->showForm($form,"agency_code") ?>
 
    <?= $model->showForm($form,"workid") ?>

    <?= $model->showForm($form,"name_hi") ?>

    <?= $model->showForm($form,"name_en") ?>

    <?= $model->showForm($form,"description") ?>

    
   
    <?= $model->showForm($form,"estcost") ?>

   
    <?= $model->showForm($form,"district_code") ?>

    <?= $model->showForm($form,"block_code") ?>

    <?= $model->showForm($form,"panchayat_code") ?>

    <?= $model->showForm($form,"village_code") ?>

    <?= $model->showForm($form,"district") ?>

    <?= $model->showForm($form,"block") ?>

    <?= $model->showForm($form,"panchayat") ?>

    <?= $model->showForm($form,"village") ?>

    <?= $model->showForm($form,"division_code") ?>

    <?= $model->showForm($form,"address") ?>

   </div>
   <div class="col-md-6">

    <?= $model->showForm($form,"work_admin") ?>

    <?= $model->showForm($form,"status") ?>

    <?= $model->showForm($form,"remarks") ?>
    <?= $this->render($attributeForm,['model'=>$attributeModel,'form'=>$form]) ?>
</div>
  
<?php
/*
try {
$x= Utility::rules()["app\modules\work\models\Work"][$changeattribute];
} catch (Exception $e) {$x=null;}
$modelArray=Yii::$app->request->post("Work");
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
