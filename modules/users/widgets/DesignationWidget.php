<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\users\widgets;
use Yii;
use yii\helpers\Html;
/**
 * Description of DesignationWidget
 *
 * @author mac
 */
class DesignationWidget  extends \yii\base\Widget{
	//put your code here
	public $model;
	public $attribute;
	public function run() {
		parent::run();
		$model=$this->model;
		$attribute=$this->attribute;
		// Normal parent select
		$lang=Yii::$app->language;
		$url=\yii\helpers\Url::to(['/users/utility/getdesignation?dt=']);
		$id=$attribute.'-id';
		echo '<div class="row"><div class="col-md-6">';
		
echo Html::dropDownList($this->attribute.'-designation-type-id','',
\yii\helpers\ArrayHelper::map(\app\modules\users\models\DesignationType::find()->asArray()->all(),'id','name_'.$lang), ['prompt'=>'Select Designation Type','class'=>'form-control','label'=>'Circle','id'=>$attribute.'-designation-type-id',
'onChange'=>"js:populateDropdown('".$url."'+$(this).val(),'".$id."')"]);

// Dependent Dropdown
//echo $form->field($model, $attribute)->widget(
echo '</div><div class="col-md-6">';
echo	Html::activeDropDownList( 
		$model,
		$attribute,[],
      ['id'=>$attribute.'-id','class'=>'form-control','prompt'=>'None']
     );
echo '</div></div>';
	}
}
