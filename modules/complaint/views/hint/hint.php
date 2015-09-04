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
<div class="newentries">
<?=Html::textInput('hint_names[]','',['class'=>'form-control','placeholder'=>'New Entry'])?>
<?=Html::textInput('hint_values[]','',['class'=>'hindiinput form-control','placeholder'=>'New Entry HIndi Name'])?>

</div>
<div id="container">
</div>
<button onclick="$('#container').append($('.newentries').clone());return false;">Add New</button>
<?php

?>    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
