<?php

namespace app\modules\formats\controllers;

use yii\web\Controller;
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
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $formatParameter=[
          'ponds'=>  [
              'name'=>'Number of Ponds',
              'type'=>'numeric',
              
            ],
        
        ];
        $binding=[
          'district'=>[
               'name'=>'District',
               'values'=>'{12:\'Agra\',23:\'Varanasi\'}'
          ],
           'finyear'=>[
               'name'=>'Financial Year',
               'values'=>"{'2014-15':'2014-2015','2015-16':'2015-16'}"
          ],
           'scheme'=>[
               'name'=>'Scheme',
               'values'=>"{'mjba':'Mukhyamantri Jal Bachao Abhiyan'}"
          ],
        
        ];
         $formatParameterBinding=[
          'ponds'=>  [
             'mandatory'=> ['district','finyear','scheme'],
             'optional'=>[],
             'target'=>true,

              
            ],
        
        ];
        $format=[
          'ponds-target-districtwise-under-mukhyamantrijalbachaoabhiyan'=>  [
              'name'=>'Number of Ponds-Target Under Mukhya Mantri Jal Bachao Abhiyan',
              'bindings'=>['district'=>['all'=>true ],'scheme'=>['all'=>false,'values'=>['mjba']],
                'finyear'=>['all'=>false,'values'=>['2015-16']]
              
            ],
        
        ];
        return $this->render('index');
    }
}
