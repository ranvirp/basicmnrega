
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
    $("a.showall").on("click",function(e){
    e.preventDefault();
    table.columns().visible(true);
    });
    $("a.toggle-vis").on( "click", function (e) {
        e.preventDefault();
 
        // Get the column API object
       
        var columnss = table.columns("."+ $(this).attr("data-column") );
//console.log(columnss)
// Toggle the visibility
table.columns().visible(false)
table.columns(".dist").visible(true)
for (index=0;index<columnss.length;index++)
  {
   for (j=0;j<columnss[index].length;j++)
   
        table.column(columnss[index][j]).visible( !table.column(columnss[index][j]).visible());
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
<div class="help-block">Help:Click on columns to sort in descending/ascending order. Type district name in search.</div>
<div>
<a class="showall">Show All Columns</a>
</div>
<div>
					Show only: <a data-column="af" class="toggle-vis">Afforestation</a> - 
					<a data-column="irr" class="toggle-vis">Irrigation</a> - 
					<a data-column="wc" class="toggle-vis">Water Conservation</a> - 
					<a data-column="agri" class="toggle-vis">Agriculture</a> -
					<a data-column="allied" class="toggle-vis">Allied</a> - 
					<a data-column="roads" class="toggle-vis">Roads</a>-
					<a data-column="san" class="toggle-vis">Sanitation</a>-
					
					<a data-column="housing" class="toggle-vis">IAY/Housing</a>-
				<a data-column="bnrgsk" class="toggle-vis">GP Bhavan/BNGSK</a>-
				<a data-column="others" class="toggle-vis">Any Other Work</a>-
					
				</div>
				<div>
					Show only: <a data-column="tw" class="toggle-vis">Total Works</a> - 
					<a data-column="ow" class="toggle-vis">Ongoing Works</a> - 
					<a data-column="cw" class="toggle-vis">Completed Works</a> - 
					<a data-column="nw" class="toggle-vis">New Works</a> -
					<a data-column="exp" class="toggle-vis">Expenditure</a> -
					<a data-column="unit" class="toggle-vis">Unit</a> - 
					<a data-column="estoutcome" class="toggle-vis">Estimated Outcome</a>-
					<a data-column="estcost" class="toggle-vis">Estimated Cost(in Lakhs)</a>
				</div>
<?php
   print '<table class="table table-striped tablesorter " id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th class="dist">Name of District</th>
    <th class="af tw">Afforestation-Total Works</th>
    <th class="af ow">Afforestation-Ongoing Works</th> 
    <th class="af cw">Afforestation-Completed Works</th> 
    <th class="af exp">Afforestation-Expenditure</th> 
    <th class="af nw">Afforestation-No of New Works</th>
    <th class="af unit">Afforestation-Unit</th>
    <th class="af estoutcome">Afforestation-Estimated Outcome</th> 
    <th class="af estcost">Afforestation-Estimated Cost(in Lakhs)</th>
    
    <th class="wc tw">Water Conservation/Harvesting-Total Works</th>
    <th class="wc ow">Water Conservation/Harvesting-Ongoing Works</th> 
    <th class="wc cw">Water Conservation/Harvesting-Completed Works</th> 
    <th class="wc exp">Water Conservation/Harvesting-Expenditure</th> 
    <th class="wc nw">Water Conservation/Harvesting-No of New Works</th>
    <th class="wc unit">Water Conservation/Harvesting-Unit</th>
    <th class="wc estoutcome">Water Conservation/Harvesting-Estimated Outcome</th> 
    <th class="wc estcost">Water Conservation/Harvesting-Estimated Cost(in Lakhs)</th>
    
    <th class="irr tw">irrigation-Total Works</th>
    <th class="irr ow">irrigation-Ongoing Works</th> 
    <th class="irr cw">irrigation-Completed Works</th> 
    <th class="irr exp">irrigation-Expenditure</th> 
    <th class="irr nw">irrigation-No of New Works</th>
    <th class="irr unit">irrigation-Unit</th>
    <th class="irr estoutcome">irrigation-Estimated Outcome</th> 
    <th class="irr estcost">irrigation-Estimated Cost(in Lakhs)</th>
    
    <th class="agri tw">Agriculture-Total Works</th>
    <th class="agri ow">Agriculture-Ongoing Works</th> 
    <th class="agri cw">Agriculture-Completed Works</th> 
    <th class="agri exp">Agriculture-Expenditure</th> 
    <th class="agri nw">Agriculture-No of New Works</th>
    <th class="agri unit">Agriculture-Unit</th>
    <th class="agri estoutcome">Agriculture-Estimated Outcome</th> 
    <th class="agri estcost">Agriculture-Estimated Cost(in Lakhs)</th>
    
    <th class="allied tw">Allied Sector-Total Works</th>
    <th class="allied ow">Allied Sector-Ongoing Works</th> 
    <th class="allied cw">Allied Sector-Completed Works</th> 
    <th class="allied exp">Allied Sector-Expenditure</th> 
    <th class="allied nw">Allied Sector-No of New Works</th>
    <th class="allied unit">Allied Sector-Unit</th>
    <th class="allied estoutcome">Allied Sector-Estimated Outcome</th> 
    <th class="allied estcost">Allied Sector-Estimated Cost(in Lakhs)</th>
    
    <th class="roads tw">Roads-Total Works</th>
    <th class="roads ow">Roads-Ongoing Works</th> 
    <th class="roads cw">Roads-Completed Works</th> 
    <th class="roads exp">Roads-Expenditure</th> 
    <th class="roads nw">Roads-No of New Works</th>
    <th class="roads unit">Roads-Unit</th>
    <th class="roads estoutcome">Roads-Estimated Outcome</th> 
    <th class="roads estcost">Roads-Estimated Cost(in Lakhs)</th>
    
    <th class="san tw">Sanitation-Total Works</th>
    <th class="san ow">Sanitation-Ongoing Works</th> 
    <th class="san cw">Sanitation-Completed Works</th> 
    <th class="san exp">Sanitation-Expenditure</th> 
    <th class="san nw">Sanitation-No of New Works</th>
    <th class="san unit">Sanitation-Unit</th>
    <th class="san estoutcome">Sanitation-Estimated Outcome</th> 
    <th class="san estcost">Sanitation-Estimated Cost(in Lakhs)</th>
    
    <th class="bnrgsk tw">GP Bhavan/BNRGSK-Total Works</th>
    <th class="bnrgsk ow">GP Bhavan/BNRGSK-Ongoing Works</th> 
    <th class="bnrgsk cw">GP Bhavan/BNRGSK-Completed Works</th> 
    <th class="bnrgsk exp">GP Bhavan/BNRGSK-Expenditure</th> 
    <th class="bnrgsk nw">GP Bhavan/BNRGSK-No of New Works</th>
    <th class="bnrgsk unit">GP Bhavan/BNRGSK-Unit</th>
    <th class="bnrgsk estoutcome">GP Bhavan/BNRGSK-Estimated Outcome</th> 
    <th class="bnrgsk estcost">GP Bhavan/BNRGSK-Estimated Cost(in Lakhs)</th>
    
    <th class="housing tw">IAY/Housing-Total Works</th>
    <th class="housing ow">IAY/Housing-Ongoing Works</th> 
    <th class="housing cw">IAY/Housing-Completed Works</th> 
    <th class="housing exp">IAY/Housing-Expenditure</th> 
    <th class="housing nw">IAY/Housing-No of New Works</th>
    <th class="housing unit">IAY/Housing-Unit</th>
    <th class="housing estoutcome">IAY/Housing-Estimated Outcome</th> 
    <th class="housing estcost">IAY/Housing-Estimated Cost(in Lakhs)</th>
    
    <th class="others tw">Others-Total Works</th>
    <th class="others ow">Others-Ongoing Works</th> 
    <th class="others cw">Others-Completed Works</th> 
    <th class="others exp">Others-Expenditure</th> 
    <th class="others nw">Others-No of New Works</th>
    <th class="others unit">Others-Unit</th>
    <th class="others estoutcome">Others-Estimated Outcome</th> 
    <th class="others estcost">Others-Estimated Cost(in Lakhs)</th>
    
    
    
    
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
                    .'<td>'.$resArr['Afforestation/horticulture'][2].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][3].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][4].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][5].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][6].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][7].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][8].'</td>'
                    .'<td>'.$resArr['Afforestation/horticulture'][9].'</td>'
                    
                    .'<td>'.$resArr['Water conservation/Harvesting'][2].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][3].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][4].'</td>'
                     .'<td>'.$resArr['Water conservation/Harvesting'][5].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][6].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][7].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][8].'</td>'
                    .'<td>'.$resArr['Water conservation/Harvesting'][9].'</td>'
                   
                    
                    .'<td>'.$resArr['Irrigation'][2].'</td>'
                    .'<td>'.$resArr['Irrigation'][3].'</td>'
                    .'<td>'.$resArr['Irrigation'][4].'</td>'
                     .'<td>'.$resArr['Irrigation'][5].'</td>'
                    .'<td>'.$resArr['Irrigation'][6].'</td>'
                    .'<td>'.$resArr['Irrigation'][7].'</td>'
                    .'<td>'.$resArr['Irrigation'][8].'</td>'
                    .'<td>'.$resArr['Irrigation'][9].'</td>'
                   
                   
                    .'<td>'.$resArr['Agriculture'][2].'</td>'
                    .'<td>'.$resArr['Agriculture'][3].'</td>'
                    .'<td>'.$resArr['Agriculture'][4].'</td>'
                     .'<td>'.$resArr['Agriculture'][5].'</td>'
                    .'<td>'.$resArr['Agriculture'][6].'</td>'
                    .'<td>'.$resArr['Agriculture'][7].'</td>'
                    .'<td>'.$resArr['Agriculture'][8].'</td>'
                    .'<td>'.$resArr['Agriculture'][9].'</td>'
                   
                     .'<td>'.$resArr['Allied sector'][2].'</td>'
                    .'<td>'.$resArr['Allied sector'][3].'</td>'
                    .'<td>'.$resArr['Allied sector'][4].'</td>'
                    .'<td>'.$resArr['Allied sector'][5].'</td>'
                    .'<td>'.$resArr['Allied sector'][6].'</td>'
                    .'<td>'.$resArr['Allied sector'][7].'</td>'
                    .'<td>'.$resArr['Allied sector'][8].'</td>'
                    .'<td>'.$resArr['Allied sector'][9].'</td>'
                    
                    .'<td>'.$resArr['Roads'][2].'</td>'
                    .'<td>'.$resArr['Roads'][3].'</td>'
                    .'<td>'.$resArr['Roads'][4].'</td>'
                     .'<td>'.$resArr['Roads'][5].'</td>'
                    .'<td>'.$resArr['Roads'][6].'</td>'
                    .'<td>'.$resArr['Roads'][7].'</td>'
                    .'<td>'.$resArr['Roads'][8].'</td>'
                    .'<td>'.$resArr['Roads'][9].'</td>'
                   
                    .'<td>'.$resArr['Sanitation'][2].'</td>'
                    .'<td>'.$resArr['Sanitation'][3].'</td>'
                    .'<td>'.$resArr['Sanitation'][4].'</td>'
                    .'<td>'.$resArr['Sanitation'][5].'</td>'
                    .'<td>'.$resArr['Sanitation'][6].'</td>'
                    .'<td>'.$resArr['Sanitation'][7].'</td>'
                    .'<td>'.$resArr['Sanitation'][8].'</td>'
                    .'<td>'.$resArr['Sanitation'][9].'</td>'
                    
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][2].'</td>'
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][3].'</td>'
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][4].'</td>'
                     .'<td>'.$resArr['GP Bhawan/BNRGSK'][5].'</td>'
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][6].'</td>'
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][7].'</td>'
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][8].'</td>'
                    .'<td>'.$resArr['GP Bhawan/BNRGSK'][9].'</td>'
                   
                    
                    .'<td>'.$resArr['IAY/Housing Scheme'][2].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][3].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][4].'</td>'
                     .'<td>'.$resArr['IAY/Housing Scheme'][5].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][6].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][7].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][8].'</td>'
                    .'<td>'.$resArr['IAY/Housing Scheme'][9].'</td>'
                   
                    .'<td>'.$resArr['Any other works'][2].'</td>'
                    .'<td>'.$resArr['Any other works'][3].'</td>'
                    .'<td>'.$resArr['Any other works'][4].'</td>'
                     .'<td>'.$resArr['Any other works'][5].'</td>'
                    .'<td>'.$resArr['Any other works'][6].'</td>'
                    .'<td>'.$resArr['Any other works'][7].'</td>'
                    .'<td>'.$resArr['Any other works'][8].'</td>'
                    .'<td>'.$resArr['Any other works'][9].'</td>'
                   
                    
                    
                    
                    .'</tr>';
                  
              
                  
             }
             
         
         else
           print '<tr><td>'.$res.'</td>'.'<td>'.$resArr.'</td></tr>';
       }
       print '</tbody></table>'; 
     
   }