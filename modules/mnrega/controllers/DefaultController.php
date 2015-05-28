<?php

namespace app\modules\mnrega\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
     public function actionGenpage($cat,$level)
     {
      //if (!Yii::$app->user->can('parameteradmin')) 
        //return;
        $level=0;
        $cat='housing';
       unset($this->layout);
       $works=new \app\modules\mnrega\models\Works;
       switch($cat)
       {
         case 'housing':
           $page='B';
           $rcode='B';
           $rsubcode='4';
           $rsec_code='W09';
           $fin_year='2015-2016';
           return $works->genWorkCategoriesPage($fin_year,$level);
         break;
         default:
         break;
       
       }
     
     
     }
}
