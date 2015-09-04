<?php
  //Enquiry Report
  //Description , Attachments
  //Jaanch by ...
  //Sanstutiyan ---
  //jaanch ka bindu --sanstuti-type-subform of relevant -type
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use app\modules\complaint\models\JobcarddemandReport;

use app\assets\AppAssetGoogle;
?>
<style>
div.required label:after {
    content: " *";
    color: red;
}
.panel-body
{
 padding:0px;
}
.item>.panel-body
{
 padding:5px;
}
.text-heading
{
 font-size:170%;
 background:#A3A4A3;
 margin:5px;
 text-align:center
}
</style>
<script>
 function _count1($elem) {
        return $elem.closest('.dynamicform_wrapper').find('.item').length-1;
    };
</script>
<div class="customer-form">
<?php AppAssetGoogle::register($this);?>
 <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<div class="col-sm-12 well">
<div class="col-lg-5 text-heading" >जॉब कार्ड की मांग का विवरण</div>
<div class="col-lg-5 text-heading">कार्यवाही का विवरण</div>
    <div class="col-lg-5"  style="margin:5px">
    
     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_hi',
            'fname',
            'mobileno',
            'address:ntext',
            'gender',
            [
             'header'=>Yii::t('app','district_code'),
             'attribute'=>'district_code',
             'value'=>$model->showValue('district_code')
            ],
            
             [
             'header'=>Yii::t('app','block_code'),
             'attribute'=>'block_code',
             'value'=>$model->showValue('block_code')
            ],
              [
             'header'=>Yii::t('app','panchayat_code'),
             'attribute'=>'panchayat_code',
             'value'=>$model->showValue('panchayat_code')
            ],
            
            'village',
            'panchayat',
        ],
    ]) ?>

    </div>
    <?php 
    //  $jobcarddemandReport=JobcarddemandReport::find()->where(['jobcarddemand_id'=>$model->id])->one();
     // if (!$jobcarddemandReport) $jobcarddemandReport=new JobcarddemandReport;
    ?>
    <div class="col-lg-5"  style="margin:5px">
    
    
    <div class="col-md-3">
     <?= $form->field($jobcarddemandReport,"complainttrue")->radioList(['0'=>Yii::t('app','False'),'1'=>Yii::t('app','Partially'),'2'=>Yii::t('app','True')])?>
    </div>
     
   <div class="col-md-12">
     <?= $form->field($jobcarddemandReport,"description")->textArea(['class'=>'hindiinput form-control'])?>
    </div>
   <div class="col-md-12">
    
      <?= $form->field($jobcarddemandReport,"jobcardno")->textInput()?>
   </div>
    <div class="form-group col-md-12">
        <?= Html::submitButton($jobcarddemandReport->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

      
    
</div>
</div>

