<?php
namespace app\modules\mnrega;
use \DomDocument;
use Yii;
class Utility
{
/**
parse a table with a given id from the dom and sends result from the column in $colwithvalue

**/
public function parseTable($link,$tableid,$rowstoskip,$colwithnames,$colswithvalue,&$result,$level=0,$district=0)
{
//Test
//$link="http://localhost/basicmnrega/web/images/page1.html";
error_reporting(0);
if ($level==0)
{
 print 'parsing '.$link;
 $result['link']=$link;
 }

        $current_encoding = mb_detect_encoding($link, 'auto');
        if ($current_encoding=='UTF-8')
        $link =utf8_decode($link);
     
        
 $baseurl_parts=parse_url($link);
 $base_path=$baseurl_parts['scheme'].'://'.$baseurl_parts['host'].'/'.$baseurl_parts['path'];
 if (key_exists('query',$baseurl_parts))
 $query=$baseurl_parts['query'];
 else
   $query='';
 
 $link=preg_replace_callback("/state_name=([^\&]+)\&/",function($matches)
 {
 //print_r($matches);
 return "state_name=".rawurlencode($matches[1])."&";},$link);
 $link=preg_replace_callback("/district_name=([^\&]+)\&/",function($matches)
 {
 //print_r($matches);
 return "district_name=".rawurlencode($matches[1])."&";},$link);
$link=preg_replace_callback("/block_name=([^\&]+)\&/",function($matches)
 {
 //print_r($matches);
 return "block_name=".rawurlencode($matches[1])."&";},$link);
$referer = "http://164.100.129.6/netnrega/all_lvl_details_dashboard_new.aspx?fin_year=2015-2016&val=sec&Digest=fyEkTtQR5Hg3F
%2fxEfIkpsA";
$referer='http://localhost';
$options = array(
        'http'=>array(
                'follow_location' => true,
                'method'=>"GET",
                'header'=>"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n" .
                "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17".
                "Referer: $referer\r\n"
        )
);


$context = stream_context_create($options);
$data = file_get_contents($link,false,$context);
print_r($data);
//if (!($data contains 'Total')) return;
 //if ($level<2)
 //exit;
 register_shutdown_function( "fatal_handler" );
   
 try{
       $dom = new domDocument;

       @$dom->loadHTML($data);
       $dom->preserveWhiteSpace = false;
       $tables=$dom->getElementsByTagName('table');
       
       if (is_numeric($tableid))
       $table=$tables->item($tableid);
       else
       $table = $dom->getElementById($tableid);
       //print "tableid=$tableid";
      // var_dump($table);
       if ($table)
       $rows = $table->getElementsByTagName('tr');
       else
        return [];
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
              // Is it a relative link (URI)?
               
              if ( !isset($url_parts['host']) || ($url_parts['host'] == '') ) {
                  // It is, so create convert to absolute url
                  $link1= $this->removeDotPathSegments($baseurl_parts['scheme'].'://'.$baseurl_parts['host'].'/'.$baseurl_parts['path'].'/../'.$link1);
               }
               
              //print 'link1='.$link1;
              $key='31';
              if (key_exists('block_code',$qarr))
                $key =$qarr['block_code'];
                else if (key_exists('district_code',$qarr))
                $key =$qarr['district_code'];
             
               $result[$key]=[];
               $this->parseTable($link1,$tableid,$rowstoskip,$colwithnames,$colswithvalue,$result[$key],$level-1);
               
            }
            }
            else 
             foreach ($colswithvalue as $colwithvalue)
             {
               if ($colwithvalue<$col->length)
              $result[$col[$colwithnames]->nodeValue][$colwithvalue]=$col[$colwithvalue]->nodeValue;
              }
           
          }
         
          
    $i++;
}
return $result;
}catch(Exception $e)
{
 print_r($e);
 return [];
 }
error_reporting(-1);
}

/**
 * Remove dot segments from a URI path according to RFC3986 Section 5.2.4
 * 
 * @param $path
 * @return string
 * @link http://www.ietf.org/rfc/rfc3986.txt
 * @link https://gist.github.com/rdlowrey/5f56cc540099de9d5006
 */
function removeDotPathSegments($path) {
    if (strpos($path, '.') === false) {
        return $path;
    }

    $inputBuffer = $path;
    $outputStack = [];

    /**
     * 2.  While the input buffer is not empty, loop as follows:
     */
    while ($inputBuffer != '') {
        /**
         * A.  If the input buffer begins with a prefix of "../" or "./",
         *     then remove that prefix from the input buffer; otherwise,
         */
        if (strpos($inputBuffer, "./") === 0) {
            $inputBuffer = substr($inputBuffer, 2);
            continue;
        }
        if (strpos($inputBuffer, "../") === 0) {
            $inputBuffer = substr($inputBuffer, 3);
            continue;
        }

        /**
         * B.  if the input buffer begins with a prefix of "/./" or "/.",
         *     where "." is a complete path segment, then replace that
         *     prefix with "/" in the input buffer; otherwise,
         */
        if ($inputBuffer === "/.") {
            $outputStack[] = '/';
            break;
        }
        if (substr($inputBuffer, 0, 3) === "/./") {
            $inputBuffer = substr($inputBuffer, 2);
            continue;
        }

        /**
         * C.  if the input buffer begins with a prefix of "/../" or "/..",
         *     where ".." is a complete path segment, then replace that
         *     prefix with "/" in the input buffer and remove the last
         *     segment and its preceding "/" (if any) from the output
         *     buffer; otherwise,
         */
        if ($inputBuffer === "/..") {
            array_pop($outputStack);
            $outputStack[] = '/';
            break;
        }
        if (substr($inputBuffer, 0, 4) === "/../") {
            array_pop($outputStack);
            $inputBuffer = substr($inputBuffer, 3);
            continue;
        }

        /**
         * D.  if the input buffer consists only of "." or "..", then remove
         *     that from the input buffer; otherwise,
         */
        if ($inputBuffer === '.' || $inputBuffer === '..') {
            break;
        }

        /**
         * E.  move the first path segment in the input buffer to the end of
         *     the output buffer, including the initial "/" character (if
         *     any) and any subsequent characters up to, but not including,
         *     the next "/" character or the end of the input buffer.
         */
        if (($slashPos = stripos($inputBuffer, '/', 1)) === false) {
            $outputStack[] = $inputBuffer;
            break;
        } else {
            $outputStack[] = substr($inputBuffer, 0, $slashPos);
            $inputBuffer = substr($inputBuffer, $slashPos);
        }
    }

    return implode($outputStack);
}

function fatal_handler() {
  $errfile = "unknown file";
  $errstr  = "shutdown";
  $errno   = E_CORE_ERROR;
  $errline = 0;

  $error = error_get_last();

  if( $error !== NULL) {
    $errno   = $error["type"];
    $errfile = $error["file"];
    $errline = $error["line"];
    $errstr  = $error["message"];

    error_mail(format_error( $errno, $errstr, $errfile, $errline));
  }
}

}