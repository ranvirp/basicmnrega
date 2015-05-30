
<?php
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
   $targetkey=4;
                  $achkey=5;
                  $target=$result['Total'][$targetkey];
                  $ach=$result['Total'][$achkey];
                  $per=sprintf('%0.2f',$target!=0?$ach/$target*100:'0.0');
   print '<table class="table table-striped tablesorter">';
   print '<tr><td>State Achievement</td><td>%Achievement</td></tr>';
   print '<tr><td>'.$ach.'</td><td>'.$per.'</td></tr>';
   print '</table>';
?>
<div class="bordered-form parameter-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>District-wise Block-wise Achievement for Persondays as on <?=date('d/m/Y',$model->update_time)?></span>
    </div>
</div>
<?php
   print '<table class="table table-striped tablesorter display" id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Name of District</th> 
    <th>Name of Block</th> 
    <th>Mandays</th> 
    <th>% achievement</th> 
    
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
                  $targetkey=4;
                  $achkey=5;
                  $target=$res1Arr[$targetkey];
                  $ach=$res1Arr[$achkey];
                  $per=sprintf('%0.2f',$target!=0?$ach/$target*100:'0.0');
                  
                    
                    
                    print '<tr>'.'<td>'.$res.'</td>'.'<td>'.$res1.'</td>'.'<td>'.$ach.'</td>'.'<td>'.$per.'</td></tr>';
                  
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