<table class="table table-bordered">
<tr><th>District</th>
<th>No of Ponds </th>
<th>No of Geotagged Photos</th>
</tr>
<?php $summary=\app\modules\mnrega\models\Pond::getSummaryCount();
$pondcount=$summary[0];
$photocount=$summary[1];
$photoindex=[];
foreach ( $pondcount as $summary1)
 {
 $photoindex[$summary1['district']]=0;
 }
foreach ($photocount as $pc)
{
 $photoindex[$pc['district']]=$pc['photocount'];
}
$area=0;
$persondays=0;
$photos=0;
$total=0;
 foreach ( $pondcount as $summary1)
 {
  $persondays+=$summary1['totalpersondays'];
  $photos+=$photoindex[$summary1['district']];
  $total+=$summary1['count'];
  
 ?>
 <tr><td><?=$summary1['district']?></td><td><?=$summary1['count']?></td>
 <td><?=$summary1['totalpersondays']?></td>
 <td><?=$photoindex[$summary1['district']]?></td>
 </tr>
<?php 
 }
 ?>
 <tr><td><strong>Total</strong></td><td><?=$total?></td>
 <td><?=$persondays?></td>
 <td><?=$photos?></td>
</table>