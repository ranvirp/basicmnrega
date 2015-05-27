<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\api;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\web\ServerErrorHttpException;

/**
 * CreateAction implements the API endpoint for creating a new model from the given data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PPRemoteAction extends \yii\rest\Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is need to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

       $modelclass=$this->modelClass;
        $access_token=Yii::$app->params['remote_aaccess_token'];
        if ($access_token=='')
          $access_token=
        $mid=Yii::$app->request->get('mid');
		$rmid=Yii::$app->request->get('rmid');
		$host=Yii::$app->request->get('host');
		
		

        $url='http://'.$host.'/'.'index.php/api/pps/'.$rmid.'?access_token='.$access_token;
        print $url."\n";
	  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$headers[] = 'Accept:application/json';
$headers[] = 'Cache-Control: no-cache';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Referer: http://localhost'; //Your referrer address
$headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0';

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//if ($mid==$rmid)
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

$model=$modelclass::findOne($mid);
$vars=$model->toArray();
if ($mid!=$rmid)
unset ($vars[$model->primaryKey()[0]]);
//var_dump($vars);
//print json_encode($vars);
//exit;
//exit;
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields

$server_output = curl_exec ($ch);

curl_close ($ch);

print  $server_output ;
    }
    function returnRemoteToken()
     {
        $ch = curl_init();
        $url='http://nregaup.in/index.php/api/default/gentoken';
        $vars=['username'=>'padmin','password'=>'padmin321'];
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = 'Accept:application/json';
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Referer: http://localhost'; //Your referrer address
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($vars));  //Post Fields

        $server_output = curl_exec ($ch);
        curl_close($ch);
        return $server_output;
     }
}
