<div id="enquiryreport-attributes">
 <div class="col-md-12">
    <?php if (!isset($enquiryreportattributes->complainttrue)) $enquiryreportattributes->complainttrue='2';?>
     <?= $form->field($enquiryreportattributes,"complainttrue")->radioList(['0'=>Yii::t('app','False'),'1'=>Yii::t('app','Partially'),'2'=>Yii::t('app','True')],['itemOptions'=>['onClick'=>'if ($(this).val()=="0") $("#complainttrue").hide(); else $("#complainttrue").show(); ' ]])?>
    </div>
    <div id="complainttrue">
    <div class="col-md-12">
    
    <?= $form->field($enquiryreportattributes,"firproposed")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
   </div>
   <div class="col-md-12">
    
    <?= $form->field($enquiryreportattributes,"daproposed")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    </div>
    <div class="col-md-12">
    
    <?= $form->field($enquiryreportattributes,"amountinvolved")->textInput()?>
    </div>
 </div>
  <div id="atr-attributes">
 <div class="col-md-12">
    <?php if (!isset($atrattributes->complainttrue)) $atrattributes->complainttrue='2';?>
     <?= $form->field($atrattributes,"complainttrue")->radioList(['0'=>Yii::t('app','False'),'1'=>Yii::t('app','Partially'),'2'=>Yii::t('app','True')],['itemOptions'=>['onClick'=>'if ($(this).val()=="0") $("#complainttrue").hide(); else $("#complainttrue").show(); ' ]])?>
    </div>
    <div id="complainttrue">
    <div class="col-md-12">
    
    <?= $form->field($atrattributes,"firdone")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
   </div>
   <div class="col-md-12">
    
    <?= $form->field($atrattributes,"dadone")->radioList(['0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')])?>
    </div>
    <div class="col-md-12">
    
    <?= $form->field($atrattributes,"amountrecovered")->textInput()?>
    </div>
 </div>