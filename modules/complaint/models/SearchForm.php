<?php
namespace app\modules\complaint\models;
class SearchForm extends \yii\base\Model
{
    public $type;
    public $id;
    public $captcha;

    public function rules()
    {
        return [
        [['type','id'],'required'],
        [['captcha'],'captcha'],
            // define validation rules here
        ];
    }
}