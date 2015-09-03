<?php
namespace app\modules\work\models;
use app\modules\mnrega\models\Block;
use app\modules\mnrega\models\Panchayat;
use app\modules\mnrega\models\District;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $uniqueid
 * @property string $workid
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 * @property string $agency_code
 * @property string $work_type_code
 * @property double $estcost
 * @property string $scheme_code
 * @property string $district_code
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $village_code
 * @property string $district
 * @property string $block
 * @property string $panchayat
 * @property string $village
 * @property string $division_code
 * @property string $address
 * @property double $gpslat
 * @property double $gpslong
 * @property integer $work_admin
 * @property integer $status
 * @property string $remarks
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 */
class Work extends \yii\db\ActiveRecord
{
   public static function statuses()
   {
     return ['0'=>'Not Started','1'=>'Ongoing','2'=>'Completed'];
   
   }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workid', 'created_at', 'updated_at', 'created_by'], 'required'],
            [['description', 'estcost', 'gpslat', 'gpslong', 'remarks'], 'string'],
            [['work_admin', 'status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['uniqueid', 'workid', 'name_hi', 'name_en', 'agency_code', 'work_type_code', 'district_code', 'block_code', 'panchayat_code', 'village_code', 'district', 'block', 'panchayat', 'village', 'division_code', 'address'], 'string', 'max' => 255],
            [['scheme_code'], 'string', 'max' => 50]
        ];
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workid' => 'Workid',
            'name_hi' =>Yii::t('app', 'Name in Hindi'),
            'name_en' => Yii::t('app','Name in English'),
            'district_code' => 'District',
            'block_code' => 'Block',
            'panchayat_code' => 'Panchayat',
            'village' => 'Village',
            
            'totarea' => 'Area',
            'estcost' => 'Estimated Cost',
           
            'gpslat' => 'Gpslat',
            'gpslong' => 'Gpslong',
            'status' => 'Status',
            'remarks' => 'Remarks',
            'scheme_code'=>Yii::t('app','Scheme'),
             'agency_code'=>Yii::t('app','Agency'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
	$designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
	   if ($designation->designationType->level->name_en=='District')
	   {
	     $district=$designation->level->code;
	     $district_name=$designation->level->name_en;
	   } else if ($designation->designationType->level->name_en=='Block')
	   {
	     $district=substr($designation->level->code,0,4);
	     $district_name=District::findOne($district)->name_en;
	   }
	   else {$district=null;$district_name=null;}
		switch ($attribute)
		  {
		   
									
			case 'id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'uniqueid':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'workid':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
			case 'agency_code':
			   return  $form->field($this,$attribute)->dropDownList(ArrayHelper::map(Agency::find()->asArray()->all(),'code','name_en'));

			    
			    break;
			case 'scheme_code':
			   return  $form->field($this,$attribute)->dropDownList(ArrayHelper::map(Scheme::find()->asArray()->all(),'code','name_en'));
			    
			    break;						
			case 'work_type_code':
			   return  $form->field($this,$attribute)->textInput();
			   //return $this->showValue('work_type_code');
			    
			    break;
			case 'workid':
			   return  $form->field($this,$attribute)->textInput(['id'=>'workid','class'=>'form-control required']);
			 //  ->widget(\yii\widgets\MaskedInput::className(), [
      //'mask' => '9999999999/WC/999999999999999999',
      //'options'=>['id'=>'workid','class'=>'form-control required'],
  //]);
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_code':
			 $url="'"."/basicmnrega/web/jsons/'+$(this).val()+'.json'";
			   $id='block-code';
			if ($district!=null)
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>$district])->label(false);
			   else
			     return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->orderBy('name_en asc')->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#district-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control']);
			 
			    
			    
			    break;
			    case 'district':
			    if ($district!=null)
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>$district_name,'id'=>'district-name'])->label(false);
			    else 
			       return  $form->field($this,$attribute)->hiddenInput(['id'=>'district-name'])->label(false);
			
			    break;
			    case 'block':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>'','id'=>'block-name'])->label(false);
			    
			    break;
			    case 'panchayat':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>'','id'=>'panchayat-name'])->label(false);
			    
			    break;
									
			case 'block_code':
			   $url="'"."/basicmnrega/web/jsons/'+$(this).val()+'.json'";
			   $id='pond-panchayat';
			   if ($district!=null)
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->where(['district_code'=>$district])->orderBy('name_en asc')->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#block-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control']);
			   else
			     return  $form->field($this,$attribute)->dropDownList([],["prompt"=>"None..",
			   'onChange'=>'$(\'#block-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control','id'=>'block-code']);
			 
			    
			    break;
									
			case 'panchayat_code':
			   return  
			   $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Panchayat::find()->asArray()->where(['block_code'=>$this->block_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",'id'=>'pond-panchayat',
			   'onChange'=>"$('#panchayat-name').val($('option:selected',this).text());$('#workid').val($(this).val()+'/')",'class'=>'form-control']);
			    
			    break;
									
			case 'village':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
						
			
									
			case 'estcost':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control']);
			    
			    break;
									
			
									
			case 'gpslat':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gpslong':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'status':
			      return  $form->field($this,$attribute)->dropDownList(self::statuses());
			 
			    break;
									
			case 'remarks':
			    return  $form->field($this,$attribute)->textInput();
			   
			    break;
									
			case 'created_at':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'updated_at':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'created_by':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
			 
			default:
			break;
		  }
    }
	/*
	*@return form of individual elements
	*/
	public function showValue($attribute)
	{
	    $name='name_'.Yii::$app->language;
		switch ($attribute)
		  {
		   
									
			case 'id':
			   return $this->id;			    break;
									
			case 'uniqueid':
			   return $this->uniqueid;			    break;
									
			case 'workid':
			   return $this->workid;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'agency_code':
			   return $this->agency_code;			    break;
									
			case 'work_type_code':
			   return $this->work_type_code;			    break;
									
			case 'estcost':
			   return $this->estcost;			    break;
									
			case 'scheme_code':
			   return $this->scheme_code;			    break;
									
			case 'district_code':
			   return $this->district_code;			    break;
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'panchayat_code':
			   return $this->panchayat_code;			    break;
									
			case 'village_code':
			   return $this->village_code;			    break;
									
			case 'district':
			   return $this->district;			    break;
									
			case 'block':
			   return $this->block;			    break;
									
			case 'panchayat':
			   return $this->panchayat;			    break;
									
			case 'village':
			   return $this->village;			    break;
									
			case 'division_code':
			   return $this->division_code;			    break;
									
			case 'address':
			   return $this->address;			    break;
									
			case 'gpslat':
			   return $this->gpslat;			    break;
									
			case 'gpslong':
			   return $this->gpslong;			    break;
									
			case 'work_admin':
			   return $this->work_admin;			    break;
									
			case 'status':
			   return $this->status;			    break;
									
			case 'remarks':
			   return $this->remarks;			    break;
									
			case 'created_at':
			   return $this->created_at;			    break;
									
			case 'updated_at':
			   return $this->updated_at;			    break;
									
			case 'created_by':
			   return $this->created_by;			    break;
			 
			default:
			break;
		  }
    }
	
}
