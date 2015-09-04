<style>
.sidebar
{
   //margin-left: -150px;
  //  margin-top: 150px;
   // min-height: 500px;
    z-index: 2;
}
</style>
<div class="well col-md-12 sidebar">
<div class="btn-group" role="group" aria-label="...">
<button class="btn btn-success" onclick="$('#marking').slideToggle();$.post('<?=\yii\helpers\Url::to(['/complaint/complaint/mark?a=e&id='.$model->id])?>',function(data){$('#marking').html(data);})">Mark for Enquiry </button>
<?php \yii\widgets\Pjax::begin(['id'=>'marking']);?>
<?php \yii\widgets\Pjax::end();?>

</div>
<?php
  

?>
</div>