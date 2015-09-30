<?php
namespace app\modules\complaint\models;
use Yii;
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
     public function attributeLabels()
     {
     return [
       'type' => Yii::t('app', 'Type'),
            'id' => Yii::t('app', 'Number'),
            ];
     }
}