<?php
namespace app\modules\formats\prototype;
class Data 
{
  public static function data()
   {
    return [
     'formatParameter'=>[
          'ponds-target'=>  [
              'name'=>'Number of Ponds-Target',
              'type'=>'numeric',
              
            ],
        
        ],
        'binding'=>[
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
        
        ],
         'formatParameterBinding'=>[
          'ponds-target'=>  [
             'mandatory'=> ['district','finyear','scheme'],
             'optional'=>[],
              
            ],
        
        ],
        'format'=>[
          'ponds-target-districtwise-under-mukhyamantrijalbachaoabhiyan'=>  [
              'name'=>'Number of Ponds-Target Under Mukhya Mantri Jal Bachao Abhiyan',
              'bindings'=>['district'=>['all'=>true ],'scheme'=>['all'=>false,'values'=>['mjba']],
                'finyear'=>['all'=>false,'values'=>['2015-16']]
               ],
               'parameters'=>['ponds-target']
              
            ],
        
        ],
        'bindings'=>[
          [
          
          1=>  [ 'district'=>'12',
          'finyear'=>'2014-15',
          'scheme'=>'mjba',
         
          ],
        
        ],
        'ponds-target'=>[
          '12'=> [
             'month'=>0,
           
          'finyear'=>'2014-15',
          'scheme'=>'mjba',
             'value'=>1,
            ],
           
        ],
   
   ];
   }


}