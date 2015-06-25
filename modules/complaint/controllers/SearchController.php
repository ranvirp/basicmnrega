<?php

namespace app\modules\complaint\controllers;

use yii\web\Controller;
use Yii;
use Zendesk\API\Client as ZendeskAPI;
use Zendesk\API\Http;

class SearchController extends Controller
{

   public function actionGenauth()
   {
  
$subdomain = "grievancecell";       // Your Zendesk subdomain
$username = "upmgnrega@gmail.com";         // Your Zendesk login
$oAuthId = "mnrega_complaint_management_up";          // The value you entered into the OAuth 'Unique Identifier' field
$oAuthSecret = "be6e394fd1f545d0c4e3fb815e5aa74536456c08fe637363f89a0a40ac2d0326";    // The OAuth secret given to you by Zendesk

$client = new ZendeskAPI($subdomain, $username);
if ($_REQUEST['code']) {
    $response = Http::oauth($client, $_REQUEST['code'], $oAuthId, $oAuthSecret);
    if (($client->getDebug()->lastResponseCode == 200) && ($response->access_token)) {
        echo "<h1>Success!</h1>";
        echo "<p>Your OAuth token is: " . $response->access_token . "</p>";
        echo "<p>Use this code before any other API call:</p>";
        echo "<code>&lt;?<br />\$client = new ZendeskAPI(\$subdomain, \$username);<br />\$client->setAuth('oauth_token', '" . $response->access_token . "');<br />?&gt;</code>";
    } else {
        echo "<h1>Error!</h1>";
        echo "<p>We couldn't get an access token for you. Please check your credentials and try again.</p>";
    }
} else {
    echo "<a href=\"https://" . $subdomain . ".zendesk.com/oauth/authorizations/new?response_type=code&redirect_uri=" . ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "&client_id=" . $oAuthId . "&scope=read%20write\">Click to request an OAuth token</a>";
}
   
   }
    public function actionIndex()
    {
       $mobileno=Yii::$app->request->post('mobileno');
       $ticketno=Yii::$app->request->post('ticketno');
       if ($mobileno && $ticketno)
        {
       
           $subdomain = "grievancecell";
$username  = "upmgnrega@gmail.com";
$token     = "6wiIBWbGkBMo1mRDMuVwkw1EPsNkeUj95PIz2akv"; // replace this with your token
// $password = "123456";

$client = new ZendeskAPI($subdomain, $username);
$client->setAuth('token', $token); // set either token or password
        
        }
        return $this->render('index');
    }
    
    
}