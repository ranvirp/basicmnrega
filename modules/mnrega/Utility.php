<?php
namespace app\modules\mnrega;
use \DomDocument;
class Utility
{
/**
parse a table with a given id from the dom and sends result from the column in $colwithvalue

**/
public function parseTable($link,$tableid,$rowstoskip,$colwithnames,$colswithvalue,&$result,$level=0,$district=0)
{
if ($level==0)
{
 print 'parsing '.$link;
 $result['link']=$link;
 }
$data=file_get_contents($link);
 $baseurl_parts=parse_url($link);
 $base_path=$baseurl_parts['scheme'].'://'.$baseurl_parts['host'].'/'.$baseurl_parts['path'];
    
 try{
       $dom = new domDocument;

       @$dom->loadHTML($data);
       $dom->preserveWhiteSpace = false;
       $table = $dom->getElementById($tableid);

       $rows = $table->getElementsByTagName('tr');
      $i=0;
       $m=date('m');
       $y=date('Y');
       if ($y==2016) $m=$m+12;
       $m=$m-3;
       
       foreach ($rows as $row) {
       if ($i<$rowstoskip) {$i++;continue;}
        $col = $row->getElementsByTagName('td');
        if (($level==2) && ($district!=0) && (strcmp($col[$colwithnames],$district_name)!=0))
         {$i++;continue;}
        
       
        
          //AGRA april->achievement, percentage may achievement,percentage
          if ($col[$colwithnames] && $col[$colswithvalue[0]])
          {
            if ($level>0)
            {
              $ael=$col[$colwithnames]->getElementsByTagName('a');
              if (! $ael->item(0)) 
                {
                foreach ($colswithvalue as $colwithvalue)
                $result[$col[$colwithnames]->nodeValue][$colwithvalue]=$col[$colwithvalue]->nodeValue;
                }
                else
                {
              $link1=
              trim($ael->item(0)->getAttribute('href'));
              $url_parts = parse_url($link1);
              $q=$url_parts['query'];
              parse_str($q,$qarr);//get query array
              //print 'link1='.$link1;
              $key='31';
              if (key_exists('block_code',$qarr))
                $key =$qarr['block_code'];
                else if (key_exists('district_code',$qarr))
                $key =$qarr['district_code'];
              // Is it a relative link (URI)?
              if ( !isset($url_parts['host']) || ($url_parts['host'] == '') ) {
                  // It is, so prepend our base URL
                  $link1= $base_path .'?'. $q;
               }
               $result[$key]=[];
               $this->parseTable($link1,$tableid,$rowstoskip,$colwithnames,$colswithvalue,$result[$key],$level-1);
               
            }
            }
            else 
             foreach ($colswithvalue as $colwithvalue)
              $result[$col[$colwithnames]->nodeValue][$colwithvalue]=$col[$colwithvalue]->nodeValue;
           
          }
         
          
    $i++;
}
return $result;
}catch(Exception $e)
{
 print_r($e);
 return [];
 }

}


}