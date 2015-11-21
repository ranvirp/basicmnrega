<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\JobcardDemand;

?>
<?php
$this->registerJs(
   '
        $(document).ready(function() 
    { 
       // $("#myTable").tablesorter(); 
       $("#myTable").DataTable( {aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: -1
    });
    } 
); 
    
    '
);
\app\assets\AppAssetTables::register($this);
?>
  
<?php if ($t=='complaint') {?>

 <div class="form-title">
        <div class="form-title-span">
         <span>Status of Complaints as on <?= date('d-m-Y')?></span>
        </div>
    </div>
    
<table class="table table-bordered" id="myTable">
<tr>
  <th>District</th>
  <th>Total</th>
  <?php 
  \Yii::$app->language='hi';
  foreach (Complaint::statusNames() as $s1=>$sname) {
  print "<th>$sname</th>";
        
    }?>
</tr>




<?php
if (!isset($sourceselected)) $sourceselected='';
foreach ($counts as $count)
{
 print '<tr>'
 //.'<td>'.Html::a($count['dname'],Url::to(['/complaint/'.$t.'/index?s=-1&dcode='.$count['dcode'].'&source='.$sourceselected].'&desgn='.$desgn)).'</td>'
 .'<td>'.Html::a($count['dname'],'#').'</td>'
  .'<td>'.$count['total'].'</td>';
foreach ($status as $s1=>$sname) {
$key=$q1[]='status_'.$s1."_count";;
if (array_key_exists($key,$count))
  print "<td>".Html::a($count[$key],Url::to(['/complaint/'.$t.'/index?s='.$s1.'&dcode='.$count['dcode'].'&source='.$sourceselected.'&desgn='.$desgn.'&start_date='.$start_date.'&end_date='.$end_date]))."</td>";
  else 
    print "<td>0</td>";
        
    }
print '</tr>';

}


?>
</table>
<?php } ?>
<?php if ($t=='workdemand') {?>

 <div class="form-title">
        <div class="form-title-span">
         <span>Status of Work Demand as on <?= date('d-m-Y')?></span>
        </div>
    </div>
    
<table class="table table-bordered" id="myTable">
<tr>
  <th>District</th>
  <th>Total</th>
  <?php 
  \Yii::$app->language='hi';
  foreach (WorkDemand::statusNames() as $s1=>$sname) {
  print "<th>$sname</th>";
        
    }?>
</tr>




<?php
if (!isset($sourceselected)) $sourceselected='';
foreach ($counts as $count)
{
 print '<tr>'
 //.'<td>'.Html::a($count['dname'],Url::to(['/complaint/'.$t.'/index?s=-1&dcode='.$count['dcode'].'&source='.$sourceselected].'&desgn='.$desgn)).'</td>'
 .'<td>'.Html::a($count['dname'],'#').'</td>'
  .'<td>'.$count['total'].'</td>';
foreach ($status as $s1=>$sname) {
$key=$q1[]='status_'.$s1."_count";;
if (array_key_exists($key,$count))
  print "<td>".Html::a($count[$key],Url::to(['/complaint/'.$t.'/index?s='.$s1.'&dcode='.$count['dcode'].'&source='.$sourceselected.'&desgn='.$desgn.'&start_date=&end_date=']))."</td>";
  else 
    print "<td>0</td>";
        
    }
print '</tr>';

}


?>
</table>
<?php } ?>
<?php if ($t=='jobcarddemand') {?>

 <div class="form-title">
        <div class="form-title-span">
         <span>Status of JobCard Demand as on <?= date('d-m-Y')?></span>
        </div>
    </div>
    
<table class="table table-bordered" id="myTable">
<tr>
  <th>District</th>
  <th>Total</th>
  <?php 
  \Yii::$app->language='hi';
  foreach (JobcardDemand::statusNames() as $s1=>$sname) {
  print "<th>$sname</th>";
        
    }?>
</tr>




<?php
if (!isset($sourceselected)) $sourceselected='';
foreach ($counts as $count)
{
 print '<tr>'
 //.'<td>'.Html::a($count['dname'],Url::to(['/complaint/'.$t.'/index?s=-1&dcode='.$count['dcode'].'&source='.$sourceselected].'&desgn='.$desgn)).'</td>'
 .'<td>'.Html::a($count['dname'],'#').'</td>'
  .'<td>'.$count['total'].'</td>';
foreach ($status as $s1=>$sname) {
$key=$q1[]='status_'.$s1."_count";;
if (array_key_exists($key,$count))
  print "<td>".Html::a($count[$key],Url::to(['/complaint/'.$t.'/index?s='.$s1.'&dcode='.$count['dcode'].'&source='.$sourceselected.'&desgn='.$desgn]))."</td>";
  else 
    print "<td>0</td>";
        
    }
print '</tr>';

}


?>
</table>
<?php } ?>
