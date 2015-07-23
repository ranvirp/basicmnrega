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

use app\modules\complaint\models\WorkdemandReport;

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
<div class="col-lg-5 text-heading">कार्य की मांग का विवरण</div>
<div class="col-lg-5 text-heading">कार्यवाही का विवरण</div>
    <div class="col-lg-5 " style="margin:5px">
    
     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_hi',
            'fname',
            'mobileno',
            'address:ntext',
            'gender',
            'district_code',
            'block_code',
            'panchayat_code',
            'village',
            'panchayat',
        ],
    ]) ?>

    </div>
    <?php 
   //   $workdemandReport=WorkdemandReport::find()->where(['work_demand_id'=>$model->id])->one();
     // if (!$workdemandReport) $workdemandReport=new WorkdemandReport;
    ?>
    <div class="col-lg-5" style="margin:5px">
    
    
    <div class="col-md-12">
     <?= $form->field($workdemandReport,"complainttrue")->radioList(['0'=>Yii::t('app','Work Not Given'),'1'=>Yii::t('app','Work Given')],
     ['itemOptions'=>['onClick'=>'if ($(this).val()=="1") {$("#complainttrue").hide(); $("#workdetails").show();}else {
     $("#complainttrue").show(); $("#workdetails").hide();}' ]])?>
    </div>
     
   <div class="col-md-12" class="hide" id="complainttrue">
     <?= $form->field($workdemandReport,"description")->textArea(['class'=>'form-control hindiinput'])->label(Yii::t('app','Reason for not giving work'))?>
    </div>
    <div class="col-md-12" class="hide" id="workdetails">
    <p> कार्य देने का विवरण</p>
   <div >
    
      <?= $form->field($workdemandReport,"work_id")->textInput()?>
   </div>
   <div class="col-md-12">
    
      <?= $form->field($workdemandReport,"workname")->textInput()?>
   </div>
   </div>
   <div class="form-group col-md-12">
        <?= Html::submitButton($workdemandReport->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

     </div>
      
    
</div>

 