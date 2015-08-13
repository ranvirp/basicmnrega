 <script>
  $(document).pjax('a#leftmenurefreshlink','#leftmenu',{'timeout':false,'push':false});
  $(document).pjax('a#maincontainerrefreshlink','#complaint-control-panel',{'timeout':false,'push':false});
  $(document).ready(function(){
  $("#complaint-action-div").on("pjax:end", function() {
            $('a#refreshlink').trigger('click');  //Reload GridView
             <?php if ($id==0) 
    echo " $('a#".$markingid."-action').trigger('click');";
     else
      echo " $('a#".$id."-action').trigger('click');";
     ?>
        });
   $('a#refreshlink').click(function()
   {
  
     $('a#leftmenurefreshlink').trigger('click');
     
   });
   $("#leftmenu").on("pjax:end", function() {
   
     });
  });
  </script>
<?php $details="Details about Complaint";?>
<button onclick="$('#complaint-control-panel').toggle();">Toggle Visibility</button>
<div class="row" id="complaint-control-panel" >
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
<?php \yii\widgets\Pjax::begin(['id'=>'complaint-action-div','enablePushState'=>false,'timeout'=>false]);?>
<?php \yii\widgets\Pjax::end();?>
<?=$actionbuttons?>


</div>
