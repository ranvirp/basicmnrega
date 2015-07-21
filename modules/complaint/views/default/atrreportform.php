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
use app\modules\complaint\models\EnquiryReportSummary;
use app\modules\complaint\models\EnquiryReportPoint;
use app\modules\complaint\models\AtrSummary;
use app\modules\complaint\models\AtrPoint;

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
<div class="col-lg-5 text-heading" >जांच आख्या का विवरण</div>
<div class="col-lg-5 text-heading">कार्यवाही का विवरण</div>
    <div class="col-lg-5" style="margin:5px">
    
   <?= DetailView::widget([
        'model' => $model->enquiryReportSummary,
        'attributes' => [
            'id',
            'reportby',
            'description',
            'complainttrue',
            'firproposed',
            'daproposed',
            'amountinvolved',

        ],
    ]) ?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($model,"attachments")?>
    </div>
    <?php 
      $atrsummary=AtrSummary::find()->where(['complaint_id'=>$model->id])->one();
      if (!$atrsummary) {$atrsummary=new AtrSummary;
      $atrsummary->complaint_id=$model->id;
      }
    ?>
    <div class="col-lg-5" style="margin:5px">
    <div class="col-md-12">
    
      <?= $form->field($atrsummary,"description")->textArea(['class'=>'hindiinput form-control'])?>
   </div>
   <div class="col-md-12">
   
      <?= $form->field($atrsummary,"attachments")->widget(\app\modules\reply\widgets\FileWidget::className())?>
    </div>
   <div class="col-md-12">
    
      <?= $form->field($atrsummary,"amountrecovered")->textInput()?>
   </div>
   <div class="col-md-12">
    
      <?= $form->field($atrsummary,"firdone")->textInput()?>
   </div>
   <div class="col-md-12">
    
      <?= $form->field($atrsummary,"dadone")->textInput()?>
   </div>
 
    
     </div>
    </div>
      
    
</div>
<div class="col-sm-12 ">
<div class="col-lg-5 text-heading" style="margin:5px">जांच के अन्य बिंदु</div>
<div class="col-lg-5 text-heading" style="margin:5px">बिंदु वार का विवरण</div>

   
<?php foreach ($model->enquiryReportsPoint as $ep) {?>
   <div class="row">
    <div class="col-lg-5" style="margin:5px">

     <?= DetailView::widget([
        'model' => $ep,
        'attributes' => [
            'id',
            
            'report',

        ],
    ]) ?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($ep,"attachments")?>
    </div>
    <?php 
      $complaint_point_id=$ep->complaint_point_id;
      $atrpoint=AtrPoint::find()->where(['complaint_point_id'=>$complaint_point_id])->one();
      if (!$atrpoint)
      {
         $atrpoint=new AtrPoint;
         $atrpoint->complaint_point_id=$complaint_point_id;
      }
    ?>
    <div class="col-lg-5" style="margin:5px">
    <div class="col-md-12">
      <?= $form->field($atrpoint,"[{$complaint_point_id}]atrstatus")->textArea(['class'=>'hindiinput form-control'])?>
   
      <?= $form->field($atrpoint,"[{$complaint_point_id}]attachments")->widget(\app\modules\reply\widgets\FileWidget::className())?>
    </div>
    <div class="col-md-12">
      <?= $form->field($atrpoint,"[{$complaint_point_id}]amountrecovered")->textInput()?>
       <?= $form->field($atrpoint,"[{$complaint_point_id}]firdone")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    <?= $form->field($atrpoint,"[{$complaint_point_id}]firdetails")->textArea(['class'=>'hindiinput'])?>
   
    </div>
    <div class="col-md-12">
     <?= $form->field($atrpoint,"[{$complaint_point_id}]dadone")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    <?= $form->field($atrpoint,"[{$complaint_point_id}]dadetails")->textArea(['class'=>'hindiinput'])?>
   
    </div>
   
    
     
   
   
    
    </div>
    
    
   
   
    </div>
 
    <?php }?>
    </div>
</div> 
 <div class="form-group">
        <?= Html::submitButton($atrsummary->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>
