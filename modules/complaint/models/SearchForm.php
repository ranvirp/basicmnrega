<?php
namespace app\modules\complaint\models;
class SearchForm extends \yii\base\Model
{
    public $mobileno;
    public $ticketno;

    public function rules()
    {
        return [
            // define validation rules here
        ];
    }
}