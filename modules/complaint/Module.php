<?php

namespace app\modules\complaint;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\complaint\controllers';

    public function init()
    {
        parent::init();
        $this->layout="//complaint";
        // custom initialization code goes here
    }
}
