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

.panel-body
{
 padding:0px;
}
.item>.panel-body
{
 padding:5px;
}
</style>
<?php $canagent=Yii::$app->user->can('complaintagent'); 
//echo $canagent;
?>
<script>
<?php if ($canagent) {?>
$(document).ready(function(){
$('#search').click(function()
{ 
      $('input[name="ComplaintSearch[mobileno]"]').val($('#mobileno').val());

     $('input[name="ComplaintSearch[name_hi]"]').val($('#complaint-name_hi').val());
     $('input[name="ComplaintSearch[mobileno]"]').trigger('change');
     //$('input[name="ComplaintSearch[name_hi]"]').trigger('change');
  // $('.grid-view').yiiGridView('applyFilter');
    return false;
//$.pjax.reload({container:'#complaint-lists'});

});

});
<?php }?>
 function _count1($elem) {
        return $elem.closest('.dynamicform_wrapper').find('.item').length-1;
    };
</script>
<?php
if ($canagent) 
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
         
       
    <?php if ($canagent) {?>
    <td>
     <button id="search">Search</button>
    </td>
    <?php } ?>
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
        <?php if ($canagent) { ?>
   <div class="col-sm-12">
     <?=$form->field($modelComplaint,'flowtype')->dropDownList([0=>'Simple',1=>'Complex'])->label('Work Flow Type') ?>
   </div>
   <?php } ?>
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
       


          <?=$this->render('../complaint/singlemarkingform',['form'=>$form,'modelComplaint'=>$modelComplaint])?>

  
     </div>
        </div>
       
        
    </div>

 </div>
   

    <table class="table table-striped" id="prevcomp">
    
    </table>
   <?php if (!Yii::$app->user->isGuest) {?>
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
    <?php } ?>
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