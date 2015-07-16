
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
$result=\app\modules\mnrega\Utility::ranking();
if (!is_array($result))
   print "Invalid result array";
   
   else {
     $blocks=json_decode(file_get_contents(__DIR__."/../../../../web/jsons/block.json"),true);
 
  
?>
<div class="bordered-form parameter-form">
  <div class="form-title">
    <div class="form-title-span">
        <span>District-wise Block-wise Overall Marks for All Parameters</span>
    </div>
</div>
<?php
   print '<table class="table table-striped tablesorter display" id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Name of District</th> 
    <th>Name of Block</th> 
    <th>Target Persondays</th> 
    <th>Achieved Persondays</th> 
    <th>% Achievement Persondays</th> 
    <th>Cumulative Household demand</th> 
    <th>Cumulative Household employment provided</th> 
    <th>% Provision</th> 
    <th>% Women</th> 
    <th>Total Muster Roll</th>
    <th>Filled Muster Roll</th>
    <th>Muster Roll(w payment)</th>
    <th>Muster Roll With No MB</th>
    <th>Total Marks<th>
   
    
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
        
            
                  
                    
                    
                    print '<tr>'.'<td>'.$res.'</td>'.'<td>'.$blocks[$res1].'</td>'
                    .'<td>'.$res1Arr['mandaystarget'].'</td>'
                     .'<td>'.$res1Arr['mandaysach'].'</td>'
                    .'<td>'.$res1Arr['mandaysper'].'</td>'
                    .'<td>'.$res1Arr['cumhhd'].'</td>'
                    .'<td>'.$res1Arr['cumhhp'].'</td>'
                    .'<td>'.$res1Arr['demandper'].'</td>'
                    .'<td>'.$res1Arr['womenper'].'</td>'
                   .'<td>'.$res1Arr['mustroll'].'</td>'
                   .'<td>'.$res1Arr['mustrollfilled'].'</td>'
                    .'<td>'.$res1Arr['withoutpaymentdate'].'</td>'
                     .'<td>'.$res1Arr['withnomb'].'</td>'
                      .'<td>'.$res1Arr['totalmarks'].'</td>'
                
                    
                    .'</tr>';
                  
                }
               
                  
             
            
         }
         else
           print '<tr><td>'.$res.'</td>'.'<td>'.$resArr.'</td></tr>';
       }
       print '</tbody></table>'; 
     
   }
   ?>