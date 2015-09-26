<?php

namespace app\modules\documents\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLink()
    {
    	return $this->render('link');
    }
}
