<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

  


 <div class="form-title">
        <div class="form-title-span">
         <span>Status of Complaints as on <?= date('d-m-Y')?></span>
        </div>
    </div>
    
<table class="table table-bordered">
<tr>
  <th>District</th>
  <th>Total</th>
  <?php foreach ($status as $s1=>$sname) {
  print "<th>$sname</th>";
        
    }?>
</tr>




<?php
foreach ($counts as $count)
{
 print '<tr>'
 .'<td>'.Html::a($count['dname'],Url::to(['/complaint/'.$t.'/index?s=-1&dcode='.$count['dcode']])).'</td>'
  .'<td>'.$count['total'].'</td>';
foreach ($status as $s1=>$sname) {
$key=$q1[]='status_'.$s1."_count";;
if (array_key_exists($key,$count))
  print "<td>".Html::a($count[$key],Url::to(['/complaint/'.$t.'/index?s='.$s1.'&dcode='.$count['dcode']]))."</td>";
  else 
    print "<td>0</td>";
        
    }
print '</tr>';

}


?>
</table>
