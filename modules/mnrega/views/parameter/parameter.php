<?php
\app\assets\AppAssetTables::register($this);

switch ($t)
{
case 'mandays':
$this->registerJs(
   '$(document).ready(function() 
    { 
       // $("#myTable").tablesorter(); 
       $("#myTable").DataTable( {aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: -1
    });
    } 
); ');
break;
case 'houses':
 $this->registerJs('      $(document).ready(function() 
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
); ');
break;
default:
break;
}
echo $data;
?>