<?php

namespace app\modules\complaint\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{

    
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionJobdemand()
    {
       $model=new \app\modules\complaint\models\JobDemand;
       return $this->render('jobdemand',['model'=>$model]);
      
    }
    
}
