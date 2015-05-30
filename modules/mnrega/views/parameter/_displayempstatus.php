
<?php
use yii\helpers\Html;
$this->registerJs(
   '$("document").ready(function(){ 
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
    
    });'
);
if (!is_array($result))
   print "Invalid result array";
   
   else {
   /*
                  $targetkey=4;
                  $achkey=5;
                  $target=$result['Total'][$targetkey];
                  $ach=$result['Total'][$achkey];
                  $per=sprintf('%0.2f',$target!=0?$ach/$target*100:'0.0');
   print '<table class="table table-striped tablesorter">';
   print '<tr><td>State Achievement</td><td>%Achievement</td></tr>';
   print '<tr><td>'.$ach.'</td><td>'.$per.'</td></tr>';
   print '</table>';
   */
?>
<div class="bordered-form parameter-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>District-wise Block-wise Achievement on Women Participation etc. as on <?=date('d/m/Y',$model->update_time)?></span>
    </div>
</div>
<div class="help-block">Help:Click on columns to sort (ascending/descending both). Search for Total in search box for district wise data</div>
 
<?php
   print '<table class="table table-striped tablesorter display" id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Name of District</th> 
    <th>Name of Block</th> 
    <th>Cumulative Demand(HH)</th> 
    <th>Cumulative Employment(HH)</th>
    <th>Employment during Month(HH)</th>
    <th> Total Persondays</th> 
    <th> SC (%)</th>
    <th> ST(%)</th>
    <th> Women(%)</th>
    <th> Household completing 100days </th>
    <th> Individual Beneficiaries</th>
    <th>Disabled Beneficiaries</th>
    
</tr> 
</thead> <tbody>';
      foreach ($result as $res=>$resArr)
      {
       $dis=\app\modules\mnrega\models\District::findOne($res);
       if ($dis) $res=$dis->district_name;
       else 
         continue;
        if (is_array($resArr))
         {
           foreach ($resArr as $res1=>$res1Arr)
           {
                
             if ($res1!='link')
             { 
               if (is_array($res1Arr))
                {
                  $cumhhd=6;
                  $cumhhp=8;
                  $hhmonth=9;
                  //$persondaysprojected=10;
                  $pda=14;//person days achievment
                  if ($res1Arr[$pda]==0)
                  $res1Arr[$pda]=1;
                  $hh100=16;
                  $indland=17;
                  $disabled=18;
                  $women=15;
                  $st=12;
                  $sc=11;
                  if (is_numeric($res1))
                    {
                      $pda=$pda-1;
                      $cumhhd=$cumhhd-1;
                      $cumhhp=$cumhhp-1;
                      $hhmonth=$hhmonth-1;
                      $hh100=$hh100-1;
                      $indland=$indland-1;
                      $disabled=$disabled-1;
                      $sc=$sc-1;
                      $st=$st-1;
                      $women=$women-1;
                    }
                     if ($res1Arr[$pda]==0)
                     {
                  $res1Arr[$pda]=1;
                  }
                  
                 // $persondaysachievmentper=sprintf('%0.2f',$res1Arr[$persondaysachievment]/$res1Arr[$persondaysprojected]*100);
                  $scper=sprintf('%0.2f',$res1Arr[$sc]/$res1Arr[$pda]*100);
                  $stper=sprintf('%0.2f',$res1Arr[$st]/$res1Arr[$pda]*100);
                  $womenper=sprintf('%0.2f',$res1Arr[$women]/$res1Arr[$pda]*100);
                  
                  
                    
                    
                    print '<tr>'.'<td>'.$res.'</td>';
                    if (is_numeric($res1))
                    {
                     print '<td>Total</td>';
                     }
                     else
                    print '<td>'.$res1.'</td>';
                    print '<td>'.$res1Arr[$cumhhd].'</td>'
                    .'<td>'.$res1Arr[$cumhhp].'</td>'
                    .'<td>'.$res1Arr[$hhmonth].'</td>'
                    .'<td>'.$res1Arr[$pda].'</td>'
                    .'<td>'.$scper.'</td>'
                    .'<td>'.$stper.'</td>'
                    
                    .'<td>'.$womenper.'</td>'
                    .'<td>'.$res1Arr[$hh100].'</td>';
                  //  if (array_key_exists($indland,$res1Arr))
                    print '<td>'.$res1Arr[$indland].'</td>';
                    // if (array_key_exists($disabled,$res1Arr))
                    print '<td>'.$res1Arr[$disabled].'</td>';
                    
                    
                    print '</tr>';
                  
                }
                else
                  print '<tr>'.'<td>'.$res.'</td>'.'<td>'.$res1.'</td>'.'<td>'.$res1Arr.'</td></tr>';
                  
             }
           }  
         }
         else
           print '<tr><td>'.$res.'</td>'.'<td>'.$resArr.'</td></tr>';
       }
       print '</tbody></table>'; 
     
   }