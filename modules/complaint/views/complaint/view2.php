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
       
       
    </p>
    <?php } ?>
<div class="col-sm-12 well" >
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

<div class="col-md-12 well">
<div class="col-lg-5 text-heading" >शिकायत का विवरण</div>
<div class="col-lg-5 text-heading">जांच आख्या/कार्यवाही का विवरण</div>
</div>
<div class="col-md-12">
    <div class="col-lg-5" style="margin:5px">
    
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
       
  
    <div class="col-lg-5" style="margin:5px">
    <?php foreach ($model->markings as $marking) { 
      echo '<div class="col-md-12">';
       if ($model->status==Complaint::ATR_RECEIVED && Yii::$app->user->can('complaintadmin'))
         echo Complaint::getButton($model->id,'acceptatrreport');
         //.Complaint::getButton($model->id,'rejectenquiryreport');
      echo '</div>';
      ?>
      <?=$this->render('list',['replies'=>$model->getReplies($marking->id)]);?>
    
    <?php }?>
    </div>
    </div>
  