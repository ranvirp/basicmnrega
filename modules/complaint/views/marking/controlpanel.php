<?php $details="Details about Complaint";?>
<div class="row id="complaint-control-panel" >
<div class="col-md-8">
 <div class="bordered-form">
  <div class="form-title">
    <div class="form-title-span">
        <span><?= $details ?></span>
    </div>
  </div>
 </div>
 <?=$complaintview ?>
 </div>
<div class="col-md-4">
<div class="bordered-form complaint-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>Action Panel</span>
    </div>
</div>
</div>
<?php \yii\widgets\Pjax::begin(['id'=>'complaint-action-div','enablePushState'=>false,'timeout'=>false]);
\yii\widgets\Pjax::end();?>
<?=$actionbuttons?>


</div>