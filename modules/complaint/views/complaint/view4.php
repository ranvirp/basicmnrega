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
<?php $canadmin=Yii::$app->user->can('complaintadmin');?>
<?php if (Yii::$app->user->can('marktopo')) {?>
 <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
       
    </p>
    <?php } ?>
 
<div class="col-md-12">
<div class="col-md-5 text-heading" >शिकायत का विवरण</div>
<div class="col-md-6 text-heading">जांच आख्या</div>
</div>
<div class="col-md-12">
    <div class="col-md-5" style="margin:5px">
    
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
    
       
  
    <div class="col-md-6" style="margin:5px">
    <?php if ($enquiryreportsummary) { 
 
      ?>
      <div class="col-md-12 pull-right">
     <small><?php switch($enquiryreportsummary->accepted)
               {
                 case 0: echo Yii::t('app','Not Reviewed');break;
                 case 1: echo Yii::t('app','Accepted');break;
                  case 2: echo Yii::t('app','Rejected');break;
                  default: break;
                
               
               }
                ?></small>
     </div>
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
    
</div>
<?php if ($model->complaintPoints)  {?>    
<div class=" col-md-12 well">
<div class="col-md-5 text-heading" style="margin:5px">शिकायत के अन्य बिंदु</div>
<div class="col-md-6 text-heading" style="margin:5px">बिंदु वार जांच आख्या</div>
</div>
   
<?php foreach ($model->complaintPoints as $cp) {?>
   <div class="col-md-12">
    <div class="col-md-5" style="margin:5px">

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

    <div class="col-md-6" style="margin:5px">
<?php if($enquiryreportspoint && $enquiryreportspoint[$cp->id]){ ?>
       <div class="col-md-12 pull-right">
     <small><?php switch($enquiryreportspoint[$cp->id]->accepted)
               {
                 case 0: echo Yii::t('app','Not Reviewed');break;
                 case 1: echo Yii::t('app','Accepted');break;
                  case 2: echo Yii::t('app','Rejected');break;
                  default: break;
                
               
               }
                ?></small>
     </div>
 <div class="col-md-12">
     <?= DetailView::widget([
        'model' => $enquiryreportspoint[$cp->id],
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
    <?=\app\modules\reply\models\File::showAttachmentsInline($enquiryreportspoint[$cp->id],"attachments")?>
    </div>
     <?php } ?>
     </div>
   
  

     
   
    
    
    
   
   
    </div>
 
    <?php }?>
   <?php }?>
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