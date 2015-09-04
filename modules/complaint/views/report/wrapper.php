<?php
use yii\helpers\Url;
use yii\helpers\Html;
app\assets\AppAssetTables::register($this);
?>
<script>
$(document).ready(function(){
$('input[name="source"]').change(function(){
 populateHtml("<?=Url::to(['/complaint/report/dwise?t=complaint&source='])?>"+$(this).val()+'&desgn='+$('input[name="level"]:checked').val(),'report');
 return false;
});
$('input[name="level"]').change(function(){
 populateHtml("<?=Url::to(['/complaint/report/dwise?t=complaint&desgn='])?>"+$(this).val()+'&source='+$('input[name="source"]:checked').val(),'report');
 return false;
});
});
</script>
<button onclick="javascript:window.print()">Print This Webpage</button>
<br>
<?php
echo '<label class="control-label">Date Range</label>';
echo '<div class="input-group drp-container">';
echo  \kartik\daterange\DateRangePicker::widget([
    'name'=>'date_range_1',
    //'value'=>'01-July-15 30-Aug-15',
    'convertFormat'=>true,
    'useWithAddon'=>true,
    'presetDropdown'=>true,
    'hideInput'=>true,
    'language'=>'en',
    'pluginOptions'=>[
        'format'=>'d-M-y',
        'separator'=>'to',
        'opens'=>'left'
    ],
        'pluginEvents' => [
    "show.daterangepicker" => "function() { console.log(this.value+$(this).val()+'show.daterangepicker'); }",
    "hide.daterangepicker" => "function() { console.log($(this).val()+'hide.daterangepicker'); }",
    "apply.daterangepicker" => "function() { populateHtml('".Url::to(['/complaint/report/dwise?t=complaint&desgn='])."'+$(this).val()+'&source='+$('input[name=\"source\"]:checked').val()+'&daterange='+$('input[name=\"date_range_1\"]').val(),'report');console.log('apply.daterangepicker'); }",
    "cancel.daterangepicker" => "function() { console.log($(this).val()+'cancel.daterangepicker'); }",
    ],
]);
echo '</div>';
?>
<p>
<label for="level">Select Level:</label>

<?php
//<label><input type="radio" name="level" value="" checked><span>All</span></label>
  $x=["'po'","'cdo'","'dm'","'jdc'","'sqm'","'tac'"];
  $items=[];
  $items['']='All';
  
    $query="select id,shortcode from designation_type where shortcode in (".implode(",",$x).")";
    $db=Yii::$app->db;
    $counts= $db->createCommand($query)->queryAll();
    
    foreach ($counts as $n=>$value)
    {
     
     //echo '<label><input type="radio" name="level" value="'.$value['id'].'" ><span>'.strtoupper($value['shortcode']).'</span></label>';
     $items[$value['id']]=strtoupper($value['shortcode']);
    }
    foreach (\app\modules\users\models\DesignationType::otherTypes() as $code=>$name)
    {
     // echo '<label><input type="radio" name="level" value="'.$code.'" ><span>'.strtoupper($name).'</span></label>';
      $items[$code]=strtoupper($name);
    }
       
  echo Html::radiolist('level','',$items,['label'=>'Select Level:']);

?>

 <p>
<label for="source">Select Source:</label>
 
 <?php 
 //<label><input type="radio" name="source" value="" checked><span>All</span></label>
 $items=[];
 $items['']='All';
 foreach (\app\modules\complaint\models\Complaint::source() as $source=>$name) 
  {
  $items[$source]=$name;
   //echo ' <label><input type="radio" name="source" value="'.$source.'" ' .'>'.$name.'</label>';
  }
   echo Html::radiolist('source','',$items,['label'=>'Select Source:']);
  ?>
</p>
<?php \yii\widgets\Pjax::begin(['id'=>'report','enablePushState'=>false,'timeout'=>false]);?>


  <?php \yii\widgets\Pjax::end();?>