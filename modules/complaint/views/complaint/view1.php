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
use yii\widgets\DetailView;
use app\modules\complaint\models\EnquiryReportSummary;
use app\modules\complaint\models\EnquiryReportPoint;
use app\modules\complaint\models\AtrSummary;
use app\modules\complaint\models\AtrPoint;
use app\modules\complaint\models\Complaint;
use app\modules\mnrega\models\MarkingSearch;



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
<?php if (Yii::$app->user->can('marktopo')) {?>
 <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Add Comments', ['/reply/default/create','ct'=>'complaint', 'ctid' => $model->id], [
            'class' => 'btn btn-danger',
            
        ]) ?>
         <?= Html::a('View Comments', ['/complaint/complaint/viewcomments', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
          <?= Html::a('Add Comments', ['/reply/default/create', 'ct'=>'complaint', 'ctid' => $model->id], ['class' => 'btn btn-primary','onClick'=>'event.preventDefault();populateHtml($(this).attr("href"),"reply")']) ?>
       
       
    </p>
    <?php } ?>
<div class="col-sm-9 well" >
  <p><span>Status:</span><span><?=Complaint::statusNames()[$model->status]?></p>
  <p><button onClick="$('#status').toggle()">Toggle</button></p>
  <div class="col-md-12" id="status">
<?php
      $marking=new MarkingSearch;
      $marking->request_type='complaint';
      $marking->request_id=$model->id;
      $dp =$marking->search([]);
      if (Yii::$app->user->can('complaintadmin') )
        $markurl=Url::to(['/complaint/complaint/setmarkingstatus']);
     else 
       $markurl=null;
      echo '<div class="col-sm-8">';
         print $this->render('@app/modules/mnrega/views/marking/index',['searchModel'=>$marking,'dataProvider'=>$dp,'markurl'=>$markurl]);
       echo '</div>';
     
?>
</div>
</div>
<div class="col-sm-offset-3 col-sm-9 well">
<div class="col-lg-3 text-heading" >शिकायत का विवरण</div>
<div class="col-lg-3 text-heading">जांच आख्या</div>
<div class="col-lg-3 text-heading">कार्यवाही का विवरण</div>
</div>
<div class="col-sm-offset-3 col-sm-9">
    <div class="col-lg-3" style="margin:5px">
    
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
      $atrsummary=$model->atrSummary;
      
    ?>
       
  
    <div class="col-lg-3" style="margin:5px">
    <?php if ($enquiryreportsummary) { 
      echo '<div class="col-md-12">';
       if ($model->status==Complaint::ENQUIRY_REPORT_RECEIVED && Yii::$app->user->can('complaintadmin'))
         echo Complaint::getButton($model->id,'acceptenquiryreport');
         //.Complaint::getButton($model->id,'rejectenquiryreport');
      echo '</div>';
      ?>
    <div class="col-md-12">
     <?= DetailView::widget([
        'model' => $enquiryreportsummary,
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
    <?=\app\modules\reply\models\File::showAttachmentsInline($enquiryreportsummary,"attachments")?>
    </div>
     
    <?php } else echo 'Pending';?>
     </div>
         <div class="col-lg-3" style="margin:5px">
          <?php if ($atrsummary) { 
           if ($model->status==Complaint::ATR_RECEIVED && Yii::$app->user->can('complaintadmin'))
              echo Complaint::getButton($model->id,'acceptatr');
              //.Complaint::getButton($model->id,'rejectatr');
          ?>
    
    <div class="col-md-12">
     <?= DetailView::widget([
        'model' => $atrsummary,
        'attributes' => [
            'id',
            'description',
            'amountrecovered',
            'firdone',
            'dadone',
                   ],
    ]) ?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($enquiryreportsummary,"attachments")?>
    </div>
     <?php }  else echo 'Pending';?>
    
     </div>
    </div>
<?php if ($model->complaintPoints)  {?>    
<div class="col-sm-offset-2 col-sm-10 well">
<div class="col-lg-3 text-heading" style="margin:5px">शिकायत के अन्य बिंदु</div>
<div class="col-lg-3 text-heading" style="margin:5px">बिंदु वार जांच आख्या</div>
<div class="col-lg-3 text-heading" style="margin:5px">बिंदु वार कार्यवाही का विवरण</div>
</div>
   
<?php foreach ($model->complaintPoints as $cp) {?>
   <div class="col-sm-offset-3 col-sm-9">
    <div class="col-lg-3" style="margin:5px">

     <?= DetailView::widget([
        'model' => $cp,
        'attributes' => [
            'id',
            ['attribute'=>'complaint_type',
            'value'=>$cp->showValue('complaint_type'),
            ],
            ['attribute'=>'complaint_subtype',
            'value'=>$cp->showValue('complaint_subtype')],
            'description',

        ],
    ]) ?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($cp,"attachments")?>
    </div>
    <?php 
      $complaint_point_id=$cp->id;
      $enquiryreportpoint=EnquiryReportPoint::find()->where(['complaint_point_id'=>$complaint_point_id])->one();
     
    ?>
        <div class="col-lg-3" style="margin:5px">
<?php if($enquiryreportpoint){ ?>
 <div class="col-md-12">
     <?= DetailView::widget([
        'model' => $enquiryreportpoint,
        'attributes' => [
            'trueorfalse',
            'report',
            'amounttoberecovered',
            'amountfrom',
            'firproposed',
            'firproposedreason',
            'daproposed',
            'daproposeddetails'
           

        ],
    ]) ?>
    <?=\app\modules\reply\models\File::showAttachmentsInline($enquiryreportpoint,"attachments")?>
    </div>
     <?php } ?>
     </div>
   
    <?php 
      $atrpoint=AtrPoint::find()->where(['complaint_point_id'=>$complaint_point_id])->one();
     
    ?>
        <div class="col-lg-3" style="margin:5px">
<?php if($atrpoint){ ?>
<div class="col-md-12">
 
     <?= DetailView::widget([
        'model' => $atrpoint,
        'attributes' => [
            'atrstatus',
            'amountrecovered',
            'amountfrom',
            'firdone',
            'firdetails',
            'dadone',
            'dadetails'
           

        ],
    ]) ?>
    
    <?=\app\modules\reply\models\File::showAttachmentsInline($atrpoint,"attachments")?>
    
    </div>
   
  <?php } else echo 'Pending';?>  
     
   
    
    </div>
    
    
   
   
    </div>
 
    <?php }?>
   <?php }?>