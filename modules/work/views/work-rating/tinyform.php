<?php
 use yii\helpers\Html;
 use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$this->registerJs(
'
         $("document").ready(function(){ 
      $("#rating-form-'.$photoid.'").on("submit", function(event) {
            //$.pjax.reload({container:"#complaint-list"});  //Reload GridView
            //$("#complaint-grid-view").yiiGridView("applyFilter");
            event.preventDefault(); // stop default submit behavior
    $.pjax.submit(event, "#rating-div",{push:false,timeout:false});
            
        });
   
    });'
);
 
 $form = ActiveForm::begin([
    'action'=>Url::to(['/work/work-rating/rating?wtype='.$work_type.'&photoid='.$photoid.'&wid='.$workid]),
    'options'=>['id'=>'rating-form-'.$photoid],
]);
echo $form->field($model,'rating_comment')->textArea(['class'=>'hindiinput']);
echo $form->field($model,'rating')->dropDownList(\app\modules\work\models\WorkRating::ratingOptions());
echo Html::submitButton('Rate',['onClick'=>'']);
ActiveForm::end();
?>