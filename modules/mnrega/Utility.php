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
//$data=file_get_contents($link);
//$ch = curl_init();

        // set url
  //      curl_setopt($ch, CURLOPT_URL, $link);

        //return the transfer as a string
    //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
      //  $output = curl_exec($ch);

        // close curl resource to free up system resources
   //     curl_close($ch);  
       // print $output;
        $current_encoding = mb_detect_encoding($link, 'auto');
        //print $current_encoding."\n";
        if ($current_encoding=='UTF-8')
        $link =utf8_decode($link);
       // print $link."\n";
        
$baseurl_parts=parse_url($link);
//print_r($baseurl_parts);
//if ($level<2)
 //exit;
 $base_path=$baseurl_parts['scheme'].'://'.$baseurl_parts['host'].'/'.$baseurl_parts['path'];
 if (key_exists('query',$baseurl_parts))
 $query=$baseurl_parts['query'];
 else
   $query='';
 /*
 $replace="%E0%A4%89%E0%A4%A4%E0%A5%8D%E0%A4%A4%E0%A4%B0%E0%A4%AA%E0%A5%8D%E0%A4%B0%E0%A4%A6%E0%A5%87%E0%A4%B6%20";
 if (strpos($link,'à¤à¤¤à¥'))
 */
 //print $link."\n";
 $link=preg_replace_callback("/state_name=([^\&]+)\&/",function($matches)
 {
 //print_r($matches);
 return "state_name=".rawurlencode($matches[1])."&";},$link);
 
 
 
//$link=$base_path.'?'.rawurlencode($query);


//print $link."\n";
$data = file_get_contents($link);
//print $data;
 //if ($level<2)
 //exit;
    
 try{
       $dom = new domDocument;

       @$dom->loadHTML($data);
       $dom->preserveWhiteSpace = false;
       $tables=$dom->getElementsByTagName('table');
       
       if (is_numeric($tableid))
       $table=$tables->item($tableid);
       else
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