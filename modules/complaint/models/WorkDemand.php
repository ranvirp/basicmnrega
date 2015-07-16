<?php
namespace app\modules\complaint\models;
use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use app\modules\mnrega\models\Panchayat;
use app\modules\mnrega\models\MarkingSearch;

use Yii;

/**
 * This is the model class for table "workdemand".
 *
 * @property integer $id
 * @property string $name_hi
 * @property string $fname
 * @property string $gender
 * @property string $mobileno
 * @property string $address
 * @property string $jobcardno
 * @property string $district_code
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $village
 * @property integer $noofdays
 * @property string $datefrom
 * @property string $dateto
 * @property string $workchoice
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 */
class WorkDemand extends \yii\db\ActiveRecord
{
 public $marking;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workdemand';
    }
/**
     * @inheritdoc
     */
    public  function behaviors()
    {
        return 
        [
         
          [
                'class' => \app\modules\mnrega\behaviors\MarkingBehavior::className(),
                'request_type' => 'workdemand',
          ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_hi', 'fname', 'mobileno', 'district_code', 'block_code', 'panchayat_code'], 'required'],
            [['address', 'workchoice'], 'string'],
            [['mobileno','noofdays', 'author', 'create_time', 'update_time'], 'integer'],
            [['datefrom', 'dateto'], 'safe'],
            [['name_hi', 'fname', 'village'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
            [['mobileno'], 'string', 'max' => 10],
            [['jobcardno'], 'string', 'max' => 15],
            [['district_code'], 'string', 'max' => 4],
            [['block_code'], 'string', 'max' => 7],
            [['panchayat_code'], 'string', 'max' => 12],
             [['marking'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_hi' => Yii::t('app', 'Name  in Hindi'),
            'fname' => Yii::t('app', 'Father/Husband name'),
            'gender' => Yii::t('app', 'Gender'),
            'mobileno' => Yii::t('app', 'Mobileno'),
            'address' => Yii::t('app', 'Address'),
            'jobcardno' => Yii::t('app', 'Jobcardno'),
            'district_code' => Yii::t('app', 'District'),
            'block_code' => Yii::t('app', 'Block'),
            'panchayat_code' => Yii::t('app', 'Panchayat'),
            'village' => Yii::t('app', 'Village'),
            'noofdays' => Yii::t('app', 'Noofdays'),
            'datefrom' => Yii::t('app', 'Datefrom'),
            'dateto' => Yii::t('app', 'Dateto'),
            'workchoice' => Yii::t('app', 'Workchoice'),
            'author' => Yii::t('app', 'Author'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
	/*
	*@return form of individual elements
	*/
	
		   
									
			 public function showForm($form,$attribute)
	{
	  
		switch ($attribute)
		  {
		   
									
			case 'jobcardno':
			   return  $form->field($this,$attribute)->textInput();
			   /*
			   ->widget(\yii\widgets\MaskedInput::className(), [
      'mask' => '',
      'options'=>['id'=>'workid','class'=>'form-control required'],
  ]);
			*/    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
			case 'fname':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
			    case 'gender':
			   return  $form->field($this,$attribute)->radioList(['M'=>'Male','F'=>'Female']);
			    
			    break;
			
			case 'mobileno':
			   return  $form->field($this,$attribute)->textInput(['size'=>10]);
			    
			    break;
			
									
			
									
			case 'district_code':
			$url1="'".Yii::getAlias('@web')."/jsons/'+$(this).val()+'.json'";
			   $id1='workdemand-block_code';
			   
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'populateDropdown('.$url1.",'".$id1."')",'class'=>'form-control']);
			    
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
			   $id='workdemand-panchayat';
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->where(['district_code'=>$this->district_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'populateDropdown('.$url.",'".$id."')",'class'=>'form-control']);
			    
			    break;
									
			case 'panchayat_code':
			   return  
			   $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Panchayat::find()->asArray()->where(['block_code'=>$this->block_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",'id'=>'workdemand-panchayat',
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
			   return  $form->field($this,$attribute)->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>['onChange'=>"$('#deadline').val($(this).val())"],
]);
			    break;
									
			case 'dateto':
			   return  $form->field($this,$attribute)->widget(\yii\jui\DatePicker::classname(), [
    'dateFormat' => 'yyyy-MM-dd',
]);
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
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'fname':
			   return $this->fname;			    break;
									
			case 'gender':
			   return $this->gender;			    break;
									
			case 'mobileno':
			   return $this->mobileno;			    break;
									
			case 'address':
			   return $this->address;			    break;
									
			case 'jobcardno':
			   return $this->jobcardno;			    break;
									
			case 'district_code':
			   return $this->district_code;			    break;
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'panchayat_code':
			   return $this->panchayat_code;			    break;
									
			case 'village':
			   return $this->village;			    break;
									
			case 'noofdays':
			   return $this->noofdays;			    break;
									
			case 'datefrom':
			   return $this->datefrom;			    break;
									
			case 'dateto':
			   return $this->dateto;			    break;
									
			case 'workchoice':
			   return $this->workchoice;			    break;
									
			case 'author':
			   return $this->author;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
			default:
			break;
		  }
    }
	public static function count1()
    {
     $modelSearch= new MarkingSearch;
         $designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
         $d=$designation->id;
      $modelSearch->request_type='workdemand';
      
       if (Yii::$app->user->id!=1)
       $modelSearch->receiver=$d;
       $modelSearch->status=0;
       $dp=$modelSearch->search([]);
       return $dp->totalCount;
       }
}
