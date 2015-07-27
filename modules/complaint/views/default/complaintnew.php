<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\modules\complaint\models\Complaint_type;
use app\modules\complaint\models\Complaint_subtype;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintSearch;



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
$(document).ready(function(){
$('#mobileno').mouseout(function()
{ 
$('input[name="ComplaintSearch[mobileno]"]').val($(this).val());
$('.grid-view').yiiGridView('applyFilter');
//$.pjax.reload({container:'#complaint-lists'});

});
$('#complaint-name_hi').mouseout(function()
{ 
$('input[name="ComplaintSearch[name_hi]"]').val($(this).val());
$('.grid-view').yiiGridView('applyFilter');
//$.pjax.reload({container:'#complaint-lists'});

});

});
 function _count1($elem) {
        return $elem.closest('.dynamicform_wrapper').find('.item').length-1;
    };
</script>
<?php
if (Yii::$app->user->can('complaintagent')) 
{
$searchModel=new ComplaintSearch;
$dp=$searchModel->search(Yii::$app->request->get());
$dp->pagination->pageSize=1;
print $this->render('../complaint/index2',['model'=>new Complaint,'dataProvider'=>$dp,'searchModel'=>$searchModel]);

}

?>
<div class="bordered-form complaint-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Form for creating Complaint</span>
    </div>
</div>
<?php AppAssetGoogle::register($this);?>
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
    <div class="col-md-5">    
     
     
     
   <table class="table table-hover well">
   <caption>शिकायतकर्ता का विवरण</caption>
    <tr>
        <td>
            <?= $form->field($modelComplaint, 'name_hi')->textInput(['class'=>'hindiinput form-control','maxlength' => true]) ?>
        </td>
         <td >
            <?= $form->field($modelComplaint, 'fname')->textInput(['class'=>'hindiinput form-control','maxlength' => true]) ?>
        </td>
       
        <td>
            <?= $form->field($modelComplaint, 'mobileno')->textInput(['maxlength' => true,'id'=>'mobileno']) ?>
        </td>
        </tr>
        <tr>
         <td>
            <?= $form->field($modelComplaint, 'address')->textArea(['class'=>'hindiinput form-control','maxlength' => true]) ?>
        </td>
       
    
        <td >
            <?= $form->field($modelComplaint, 'jobcardno')->textInput(['maxlength' => true]) ?>
        </td>
         
       
    
    <td>
     <button onClick="populateHtml('<?=Url::to(['/complaint/complaint/search?mobileno='])?>'+$('#mobileno').val(),'prevcomp');return false;">Search</button>
    </td>
  </tr>
    </table>
     <?=$modelComplaint->showForm($form,'source')?> 
     <?=$modelComplaint->showForm($form,'manualno')?>
     <?php 
        $url=Url::to(['/complaint/complaint_subtype/get?code=']);
     ?>
     </div>
     <div class="col-md-6">
    <div class="row well" style="margin-right:0;margin-left:0!important">
        <div class="col-sm-6">
                <?= $form->field($modelComplaint, "complaint_type")->dropDownList(ArrayHelper::Map(Complaint_type::find()->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None','onChange' => 'populateDropdown("'.$url.'"+$(this).val(),"complaint-complaint_subtype")']) ?>
         </div>
        <div class="col-sm-6">
            <?= $form->field($modelComplaint, "complaint_subtype")->dropDownList(ArrayHelper::Map(Complaint_subtype::find()->where(['complaint_type_code'=>$modelComplaint->complaint_type])->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None']) ?>
        </div>
   
     <div class="col-sm-12">
      <?= $form->field($modelComplaint, "description")->textArea(['onclick' => 'hindiEnable($(this))']) ?>
</div>
 <div class="col-sm-12">

            <?= $modelComplaint->showForm($form,'attachments') ?>
 </div>
     </div>
     <div class="row well" style="margin-right:0;margin-left:0!important">
        <div class="col-sm-8">
            <?= $modelComplaint->showForm($form,'district_code') ?>
        
            <?= $modelComplaint->showForm($form,'block_code') ?>
       
            <?= $modelComplaint->showForm($form,'panchayat_code') ?>
             <?= $modelComplaint->showForm($form,'panchayat') ?>
        </div>
         
      

        <div class="col-sm-4">
       
<?php if (Yii::$app->user->can('marktopo')) {?>
 <p> Marked to </p><hl>
            <div class="checkbox">
  <label><input type="checkbox" name="maintype[]" value="po">सम्बंधित खंड विकास अधिकारी</label>
    <label><input type="checkbox" name="maintype[]" value="cdo">सम्बंधित मुख्य विकास अधिकारी </label>
  <label><input type="checkbox" name="maintype[]" value="dcmnrega">सम्बंधित उपायुक्त श्रम रोज़गार </label>

<?php };?>
<?php if (Yii::$app->user->can('marktosqm')) {?>

  <label><input type="checkbox" name="maintype[]" value="sqm">सम्बंधित राज्य गुणवत्ता मॉनिटर</label>
    <label><input type="checkbox" name="maintype[]" value="lokpal">सम्बंधित मनरेगा लोकपाल</label>

<?php };?>
<?php if (Yii::$app->user->can('marktoothers')){ ?>
  <label><input type="checkbox" name="" onClick="$('#designation-select').toggle()" >Others</label>
<?php } ?>
</div>
 <?= $form->field($modelComplaint,'marking[deadline]')->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
])->label('Deadline')?>
<div id="designation-select" style="display:none">
<div id="form1">
<?= $form->field($modelComplaint,'marking[designation][]')->widget(\app\modules\users\widgets\DesignationWidget::className())->label(false)?>
</div>
  
</div>
        </div>
       
        
    </div>

 </div>
   

    <table class="table table-striped" id="prevcomp">
    
    </table>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be added (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsComplaintPoint[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'complaint_type',
            'complaint_subtype',
            'description',
            'attachments',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-zoom-in"></i> शिकायत/जांच  के बिंदु 
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
            <?php foreach ($modelsComplaintPoint as $i => $modelComplaintPoint): ?>
                <div class="item panel panel-default" item-index="{$i}" id="item-{$i}"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">शिकायत/जांच बिंदु </h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelComplaintPoint->isNewRecord) {
                                echo Html::activeHiddenInput($modelComplaintPoint, "[{$i}]id");
                            }
                        ?>
                        <?php 
                        $url=Url::to(['/complaint/complaint_subtype/get?code=']);
                        ?>
                        
                       <div class="row">
                           <div class="col-sm-6">
                            <?= $form->field($modelComplaintPoint, "[{$i}]complaint_type")->dropDownList(ArrayHelper::Map(Complaint_type::find()->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None','onChange' => 'populateDropdown("'.$url.'"+$(this).val(),"complaintpoint-"+_count1($(this))+"-complaint_subtype")']) ?>
                           </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelComplaintPoint, "[{$i}]complaint_subtype")->dropDownList(ArrayHelper::Map(Complaint_subtype::find()->where(['complaint_type_code'=>$modelComplaintPoint->complaint_type])->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None']) ?>
                            </div>
                      </div>
                      <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($modelComplaintPoint, "[{$i}]description")->textArea(['onclick' => 'hindiEnable($(this))']) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelComplaintPoint, "[{$i}]attachments")->widget(\app\modules\reply\widgets\FileWidget::classname())?>
                            </div>
                            
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
    <?php if (Yii::$app->user->isGuest) {?>
   <div class="form-group">
   <?= $form->field($modelComplaint, 'captcha')->widget(\yii\captcha\Captcha::classname(),['captchaAction' => '/site/captcha'])?>
   </div>
   <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($modelComplaint->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>