<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
//use yii\filters\auth\CompositeAuth;
//use yii\filters\auth\HttpBasicAuth;
//use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use Yii;

class WorkController  extends ActiveController
{
    public $modelClass = 'app\modules\mnrega\models\Pond';
	
	public function behaviors()
{
    $behaviors = parent::behaviors();
    $behaviors['authenticator'] = [
        'class' => 
            QueryParamAuth::className(),
        'tokenParam'=>'access_token',
        
    ];
    return $behaviors;
}
public function actions()
    {
    return array_merge(parent::actions(),['index' => [
                'class' => '\app\modules\api\WorkFindAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            ]);
    }
}
?>