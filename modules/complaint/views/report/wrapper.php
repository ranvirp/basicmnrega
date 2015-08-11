<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<script>
$(document).ready(function(){
$('input[name="source"]').change(function(){
 populateHtml("<?=Url::to(['/complaint/report/dwise?t=complaint&source='])?>"+$(this).val()+'&desgn='+$('input[name="level"]').val(),'report');
 return false;
});
$('input[name="level"]').change(function(){
 populateHtml("<?=Url::to(['/complaint/report/dwise?t=complaint&desgn='])?>"+$(this).val()+'&source='+$('input[name="source"]').val(),'report');
 return false;
});
});
</script>
<button onclick="javascript:window.print()">Print This Webpage</button>
<p>
<label for="level">Select Level:</label>
<label><input type="radio" name="level" value="" ><span>All</span></label>
<?php
  $x=["'po'","'cdo'","'dm'","'jdc'","'sqm'","'tac'"];
  
    $query="select id,shortcode from designation_type where shortcode in (".implode(",",$x).")";
    $db=Yii::$app->db;
    $counts= $db->createCommand($query)->queryAll();
    foreach ($counts as $n=>$value)
    {
     echo '<label><input type="radio" name="level" value="'.$value['id'].'" ><span>'.strtoupper($value['shortcode']).'</span></label>';
    }
       
  

?>

 <p>
<label for="source">Select Source:</label>
 <label><input type="radio" name="source" value="" ><span>All</span></label>
 <?php foreach (\app\modules\complaint\models\Complaint::source() as $source=>$name) 
  {
   echo ' <label><input type="radio" name="source" value="'.$source.'" ' .'>'.$name.'</label>';
  }
  ?>
</p>
<?php \yii\widgets\Pjax::begin(['id'=>'report','enablePushState'=>false,'timeout'=>false]);?>


  <?php \yii\widgets\Pjax::end();?>