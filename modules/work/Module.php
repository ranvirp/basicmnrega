<?php

namespace app\modules\work;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\work\controllers';

    public function init()
    {
        parent::init();
        if (\Yii::$app->user->isGuest)
          throw new \yii\web\ForbiddenHttpException('Not Allowed');
        // custom initialization code goes here
    }
}
