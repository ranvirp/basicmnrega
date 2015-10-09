<?php

namespace app\modules\taxonomy\controllers;
use app\modules\taxonomy\models\Tagging;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex($t,$ty=null)//termcode, type
    {
        $dplink=Tagging::taggedList($t,'link');
        $dpdoc=Tagging::taggedList($t,'doc');
        $terms=Tagging::terms($t);
    //    if ($ty=='link')
       return $this->render('out',['dplink'=>$dplink,'dpdoc'=>$dpdoc,'terms'=>$terms]);
    }
}
