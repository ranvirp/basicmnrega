<?php
namespace app\modules\complaint\models;
use Yii;
use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use app\modules\mnrega\models\Panchayat;

class JobDemand extends \yii\base\Model
{
    public $mobileno;
    public $jobcardno;
    public $name;
    public $fname;
    public $district_code;
    public $district;
    public $block_code;
    public $block;
    public $panchayat_code;
    public $panchayat;
    public $noofdays;
    public $datefrom;
    public $dateto;
    public $workchoice;
    public $village;

    public function rules()
    {
        return [
            // define validation rules here
        ];
    }
    public function showForm($form,$attribute)
	{
	  
		switch ($attribute)
		  {
		   
									
			case 'jobcardno':
			   return  $form->field($this,$attribute)
			   ->widget(\yii\widgets\MaskedInput::className(), [
      'mask' => '9999999999/WC/999999999999999999',
      'options'=>['id'=>'workid','class'=>'form-control required'],
  ]);
			    
			    break;
									
			case 'name':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
									
			
									
			case 'district_code':
			$url1="'".Yii::getAlias('@web')."/jsons/'+$(this).val()+'.json'";
			   $id1='jobdemand-block_code';
			   
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#district-name\').val($(\'option:selected\',this).text());populateDropdown('.$url1.",'".$id1."')",'class'=>'form-control']);
			    
			    break;
			    case 'district':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>$this->district])->label(false);
			    
			    break;
			    case 'block':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>'','id'=>'block-name'])->label(false);
			    
			    break;
			    case 'panchayat':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>'','id'=>'panchayat-name'])->label(false);
			    
			    break;
									
			case 'block_code':
			   $url="'".Yii::getAlias('@web')."/jsons/'+$(this).val()+'.json'";
			   $id='pond-panchayat';
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->where(['district_code'=>$this->district_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#block-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control']);
			    
			    break;
									
			case 'panchayat_code':
			   return  
			   $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Panchayat::find()->asArray()->where(['block_code'=>$this->block_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",'id'=>'pond-panchayat',
			   'onChange'=>"$('#panchayat-name').val($('option:selected',this).text());$('#workid').val($(this).val()+'/')",'class'=>'form-control']);
			    
			    break;
									
			case 'village':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'jobcardno':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'noofdays':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control'])->hint($this->getAttributeHint($attribute));
			    
			    break;
									
			case 'datefrom':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control']);
			    
			    break;
									
			case 'dateto':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control']);
			    
			    break;
									
						

			 
			default:
			break;
		  }
    }
}