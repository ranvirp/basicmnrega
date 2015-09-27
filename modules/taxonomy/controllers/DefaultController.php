<?php

namespace app\modules\taxonomy\controllers;
use app\modules\taxonomy\models\Tagging;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex($t,$ty=null)//termcode, type
    {
        $dp=Tagging::taggedList($t,$ty);
        if ($ty=='link')
        return $this->render('link-index',['dataProvider'=>$dp]);	
    else
        return $this->render('index',['dataProvider'=>$dp]);
    }
}
