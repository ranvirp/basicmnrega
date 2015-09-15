<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
/*
$ID = "userid";
$Pwd = "password";
$baseurl ="http://www.businesssms.co.in";
$PhNo = "910123456789";
$Text = urlencode("This is an example for message");

//Invoke HTTP Submit url
$url = "$baseurl/sms.aspx?Id=$ID&Pwd=$Pwd&PhNo=$PhNo&text=$Text";
// do sendmsg call
$ret = file($url);
//Process $ret to check whether it contains "Message Submitted"
//..............
//..............


/**
 * Description of SendSMSComponent
 *
 * @author admin
 */
class SendSMSComponent extends Component{
    public $sendsms=true;
    public $ID="";
    public $Pwd="";
    public $baseurl ="http://priority.muzztech.in";
    public $sendsms="/sms_api/sendsms.php";
    public $unicodesms="/sms_api/smsUnicode.php";
    public $balanceapi="/sms_api/balanceinfo.php";
    public $PhNo="";
    public $Text="";
   public function __construct()
    {
        
    }

    public function init()
    {
        parent::init();
        $this->ID=Yii::$app->params['muzztechsmsid'];
        $this->Pwd=Yii::$app->params['muztechsmspwd'];
    } 
     public function sendSms($event)
    {
         $x=$event->sender->getSMSDetails();
         if (is_array($x))
         {
            $this->postSms($x['PhNo'], $x['text']);
            
         }
         
         
         
     }
      public function postSms($PhNo,$text)
    {
        $ph_arr=explode(",",$PhNo);
        if (is_array($ph_arr))
        {
            foreach($ph_arr as $i=>$ph)
            {
                if (strlen($ph)!=12)
                {
                    unset($ph_arr[$i]);
                }
            }
            if (count($ph_arr)>0)
            {
               
            $PhNo=implode(",",$ph_arr);
            }
            else return;
        }
        $baseurl=$this->baseurl;
        $sendsms=$this->sendsms;
        $ID=$this->ID;
        
      $url= "$baseurl/".$sendsms;
      $parameters="username=$ID&password=$this->Pwd&mobileno=$PhNo&message=".rawurlencode($text).'&sendername=MNREGA%20Cell';
	$ch = curl_init($url);

	if(isset($_POST))
	{
	
            curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
   	if($return_val=="")
	return "Process Failed, Please check domain, username and password.";
	else
	return "$return_val";
    }
    
  public function addSMSRecords() 
  {
      $cmd=Yii::app()->db->createCommand();
      
  }
  /**
 * urlencodes complete string, including alphanumeric characters
 * @param string $string the string to encode
 */
function urlencode_all($string){
    $chars = array();
    for($i = 0; $i < strlen($string); $i++){
        $chars[] = '%'.dechex(ord($string[$i]));
    }
    return implode('', $chars);
}
}
