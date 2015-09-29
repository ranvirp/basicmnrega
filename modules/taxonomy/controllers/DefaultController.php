<?php

namespace app\modules\taxonomy\controllers;
use app\modules\taxonomy\models\Tagging;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex($t,$ty=null)//termcode, type
    {
        $dp=Tagging::taggedList($t,$ty);
        $terms=Tagging::terms($t);
        if ($ty=='link')
        return $this->render('link-index',['dataProvider'=>$dp,'terms'=>$terms]);	
    else
        return $this->render('index',['dataProvider'=>$dp]);
    }
}
