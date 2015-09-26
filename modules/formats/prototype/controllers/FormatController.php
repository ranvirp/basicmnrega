<?php

namespace app\modules\formats\prototype\controllers;

use yii\web\Controller;
use app\modules\formats\prototype;
/*
  Each format would consist of {{format_parameter}}. A format parameter 
  shall be qualified by bindings. Bindings shall be either district,block,
  financial year, scheme, or unique number. A binding shall be a class 
  implementing some interface having functions like values,....
  A format_parameter, binding table would map binding of a format_parameter 
  and binding. Similarly, a format, binding would contain mapping of format
  with binding. A format, parameter mapping would be captured in another table.
  So there are following tables:
      {{format_parameter}}
      attributes : name, type (string,numeric or dropdown), values}
      {{binding}}
      attributes:name,values
      {format_parameter__binding}} 
      attributes:format_parameter_id, binding_id
      {format_parameter__value}
      attributes: format_parameter_id,bindingid1,bindingid1value, bindingid2,
      bindingid2value, bindingid3value, bindingid4, bindingid4value, value 
      {format__format_parameter}
      attributes: formatid,parameterid
         
      

*/
class FormatController extends Controller
{
  public function actionDisplay($fid) //format id
   {
     $data = Data::data();
     $format=$data['format'][$fid];
     $parameters=$format['parameters'];
     foreach ($parameters as $parameter)
     {
        foreach ($data[$parameter] as $district_data)
         {
           foreach ($district_data as $district=>$data1)
           {
           if ($data1['month']==0)
             print $district,"  ",$data1['value'];
           
           }
         
         }
      }
     
   
   }
   public function actionForm($formatid,$district)
   {
      //print district dropdown
      //print month dropdown
      //print parameters
      //print submit button
   
   
   }
}