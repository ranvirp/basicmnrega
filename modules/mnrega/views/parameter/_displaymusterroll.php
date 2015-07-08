
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
  
?>
<div class="bordered-form parameter-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>District-wise Block-wise Achievement on Muster Rolls Status as on <?=date('d/m/Y',$model->update_time)?></span>
    </div>
</div>
<div class="help-block">Help:Click on columns to sort (ascending/descending both). Search for Total in search box for district wise data</div>
 
<?php
   print '<table class="table table-striped tablesorter display" id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Name of District</th> 
    <th>Name of Block</th> 
    <th>Printed E Muster Roll</th>
    <th>Filled E-Muster Roll </th>
    <th>Muster Roll without Date of Payment</th> 
    <th>Muster Roll without MB</th> 
    
    <th>% Muster Roll Filled</th>
    <th>% Muster Roll without Payment Date</th>
    
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
                  $mustroll=2;
                  $mustrollfilled=3;
                  $withoutpaymentdate=4;
                  $withnomb=5;
                  
                 // $persondaysachievmentper=sprintf('%0.2f',$res1Arr[$persondaysachievment]/$res1Arr[$persondaysprojected]*100);
                  $filledper=sprintf('%0.2f',$res1Arr[$mustroll]!=0?$res1Arr[$mustrollfilled]/$res1Arr[$mustroll]*100:0.0);
                 $withoutpaymentper=sprintf('%0.2f',$res1Arr[$mustroll]?$res1Arr[$withoutpaymentdate]/$res1Arr[$mustroll]*100:0.0);
                  
                    
                    
                    print '<tr>'.'<td>'.$res.'</td>';
                    if (is_numeric($res1))
                    {
                     print '<td>Total</td>';
                     }
                     else
                    print '<td>'.$res1.'</td>';
                    print '<td>'.$res1Arr[$mustroll].'</td>'
                    .'<td>'.$res1Arr[$mustrollfilled].'</td>'
                    .'<td>'.$res1Arr[$withoutpaymentdate].'</td>'
                    .'<td>'.$res1Arr[$withnomb].'</td>'
                    .'<td>'.$filledper.'</td>'
                    .'<td>'.$withoutpaymentper.'</td>';
                    
                   
               
                    
                    
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