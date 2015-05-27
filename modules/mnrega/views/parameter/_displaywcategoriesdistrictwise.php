
<?php
$this->registerJs(
   '$("document").ready(function(){ 
        $(document).ready(function() 
    { 
       // $("#myTable").tablesorter(); 
      var table= $("#myTable").DataTable( {aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: -1
    });
    $("a.toggle-vis").on( "click", function (e) {
        e.preventDefault();
 
        // Get the column API object
       
        var columns = table.columns("."+ $(this).attr("data-column") );
//console.log(columnss)
// Toggle the visibility
for (index=0;index<columns.length;index++)
  {
   for (j=0;j<columns[index].length;j++)
   
        table.column(columns[index][j]).visible( !table.column(columns[index][j]).visible());
        }
    } );

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
        <span>District-wise Work Categories wise progress as on <?=date('d/m/Y',$model->update_time)?></span>
    </div>
</div>
<div>
					Toggle column: <a data-column="af" class="toggle-vis">Afforestation</a> - 
					<a data-column="irr" class="toggle-vis">Irrigation</a> - 
					<a data-column="wc" class="toggle-vis">Water Conservation</a> - 
					<a data-column="agri" class="toggle-vis">Agriculture</a> -
					<a data-column="allied" class="toggle-vis">Allied</a> - 
					<a data-column="iay" class="toggle-vis">IAY/Housing</a>
				</div>
<?php
   print '<table class="table table-striped tablesorter " id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>Name of District</th> 
    <th class="af">Afforestation-Ongoing Works</th> 
    <th class="af">Afforestation-Completed Works</th> 
    <th class="af">Afforestation-Expenditure</th> 
    <th class="wc">Water Conservation/Harvesting-Ongoing Works</th> 
    <th class="wc">Water Conservation/Harvesting-Completed Works</th> 
    <th class="wc">Water Conservation/Harvesting-Expenditure</th> 
    <th class="irr">Irrigation-Ongoing Works</th> 
    <th class="irr">Irrigation-Completed Works</th> 
    <th class="irr">Irrigation-Expenditure</th> 
    <th class="agri">Agriculture-Ongoing Works</th> 
    <th class="agri">Agriculture-Completed Works</th> 
    <th class="agri">Agriculture-Expenditure</th> 
    <th class="allied">Allied Sector-Ongoing Works</th> 
    <th class="allied">Allied Sector-Completed Works</th> 
    <th class="allied">Allied Sector-Expenditure</th> 
    <th class="iay">IAY/Houses-Ongoing Works</th> 
    <th class="iay">IAY/Houses-Completed Works</th> 
    <th class="iay">IAY/Houses-Expenditure</th> 
    
    
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
           
                    print '<tr>'.'<td>'.$res.'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][3].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][4].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][5].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][3].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][4].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][5].'</td>'
                    .'<td>'.$resArr['Irrigation'][3].'</td>'
                    .'<td>'.$resArr['Irrigation'][4].'</td>'
                    .'<td>'.$resArr['Irrigation'][5].'</td>'
                    .'<td>'.$resArr['Agriculture'][3].'</td>'
                    .'<td>'.$resArr['Agriculture'][4].'</td>'
                    .'<td>'.$resArr['Agriculture'][5].'</td>'
                    .'<td>'.$resArr['Allied sector'][3].'</td>'
                    .'<td>'.$resArr['Allied sector'][4].'</td>'
                    .'<td>'.$resArr['Allied sector'][5].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][3].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][4].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][5].'</td>'
                   
                    
                    
                    
                    .'</tr>';
                  
              
                  
             }
             
         
         else
           print '<tr><td>'.$res.'</td>'.'<td>'.$resArr.'</td></tr>';
       }
       print '</tbody></table>'; 
     
   }