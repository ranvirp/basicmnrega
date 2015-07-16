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
<div class="row">
<div class="col-lg-6"><p class="bg-primary">Complaint Details</p></div><div class="col-lg-6"><p class="bg-success">Enquiry Report Summary</p></div>
   </div>
   <div class="row">
    <div class="col-lg-6">
    
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
            
            'panchayat',
        ],
    ]) ?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($model,"attachments")?>
    </div>
    <?php 
      $enquiryreportsummary=EnquiryReportSummary::find()->where(['complaint_id'=>$model->id])->one();
      if (!$enquiryreportsummary) {$enquiryreportsummary=new EnquiryReportSummary;
      $enquiryreportsummary->complaint_id=$model->id;
      }
    ?>
    <div class="col-lg-6">
    <div class="col-md-12">
     <?= $form->field($enquiryreportsummary,"author")->widget(\app\modules\users\widgets\DesignationWidget::className())?>
    </div>
    
    <div class="col-md-3">
     <?= $form->field($enquiryreportsummary,"complainttrue")->radioList(['0'=>Yii::t('app','False'),'1'=>Yii::t('app','Partially'),'2'=>Yii::t('app','True')])?>
    </div>
    <div class="col-md-3">
    
    <?= $form->field($enquiryreportsummary,"firproposed")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
   </div>
   <div class="col-md-3">
    
    <?= $form->field($enquiryreportsummary,"daproposed")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    </div>
    <div class="col-md-3">
    
    <?= $form->field($enquiryreportsummary,"amountinvolved")->textInput()?>
    </div>
     
   
   <div class="col-md-12">
    
      <?= $form->field($enquiryreportsummary,"description")->textArea(['class'=>'hindiinput'])?>
   </div>
   <div class="col-md-12">
   
      <?= $form->field($enquiryreportsummary,"attachments")->widget(\app\modules\reply\widgets\FileWidget::className())?>
    </div>
    
     </div>
      
    
</div>
</div>
<div class="col-sm-12 ">
<div class="row">
<div class="col-lg-6 well">Complaint Points </div><div class="col-lg-6 well">Enquiry Report Point Wise</div>
   </div>
   
<?php foreach ($model->complaintPoints as $cp) {?>
   <div class="row">
    <div class="col-lg-6 well">

    <?=$cp->showValue('id')?>
    <?=$cp->showValue('complaint_type')?>
    <?=$cp->showValue('complaint_subtype')?>
    <?=$cp->showValue('description')?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($cp,"attachments")?>
    </div>
    <?php 
      $complaint_point_id=$cp->id;
      $enquiryreportpoint=EnquiryReportPoint::find()->where(['complaint_point_id'=>$complaint_point_id])->one();
      if (!$enquiryreportpoint)
      {
         $enquiryreportpoint=new EnquiryReportPoint;
         $enquiryreportpoint->complaint_point_id=$complaint_point_id;
      }
    ?>
    <div class="col-lg-6 well">
    <div class="col-md-12">
      <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]report")->textArea(['class'=>'hindiinput'])?>
   
      <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]attachments")->widget(\app\modules\reply\widgets\FileWidget::className())?>
    </div>
    <div class="col-md-12">
      <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]trueorfalse")->radioList(['0'=>Yii::t('app','False'),'1'=>Yii::t('app','Partially'),'2'=>Yii::t('app','True')])?>
    </div>
    <div class="col-md-12">
       <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]firproposed")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]firproposedreason")->textArea(['class'=>'hindiinput'])?>
   
    </div>
    <div class="col-md-12">
     <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]daproposed")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]daproposeddetails")->textArea(['class'=>'hindiinput'])?>
   
    </div>
    <div class="col-md-12">
        <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]amounttoberecovered")->textInput()?>
    <?= $form->field($enquiryreportpoint,"[{$complaint_point_id}]amountfrom")->textArea(['class'=>'hindiinput'])?>
  
    </div>
    
     
   
   
    
    </div>
    
    
   
   
    </div>
 
    <?php }?>
    </div>
</div> 
 <div class="form-group">
        <?= Html::submitButton($enquiryreportsummary->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>
