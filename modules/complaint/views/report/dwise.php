<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<table class="table table-striped">
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
 .'<td>'.Html::a($count['dname'],Url::to(['/complaint/'.$t.'/my?s=-1&dcode='.$count['dcode']])).'</td>'
  .'<td>'.$count['total'].'</td>';
foreach ($status as $s1=>$sname) {
$key=strtolower(str_replace(" ","_",$sname)).'_count';
if (array_key_exists($key,$count))
  print "<td>".$count[$key]."</td>";
  else 
    print "<td>0</td>";
        
    }
print '</tr>';

}


?>
</table>