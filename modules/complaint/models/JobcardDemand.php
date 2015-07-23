<?php
namespace app\modules\complaint\models;
use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use app\modules\mnrega\models\Panchayat;
use app\modules\mnrega\models\MarkingSearch;
use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "jobcarddemand".
 *
 * @property integer $id
 * @property string $name_hi
 * @property string $fname
 * @property string $mobileno
 * @property string $address
 * @property string $gender
 * @property string $district_code
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $village
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 */
class JobcardDemand extends \yii\db\ActiveRecord
{
   public $marking;
   public $captcha;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jobcarddemand';
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
                'request_type' => 'jobcarddemand',
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
            [['address'], 'string'],
            [['author', 'create_time', 'update_time'], 'integer'],
            [['name_hi', 'fname', 'village'], 'string', 'max' => 255],
            [['mobileno'], 'string', 'max' => 10],
            [['gender'], 'string', 'max' => 1],
            [['district_code'], 'string', 'max' => 4],
            [['block_code'], 'string', 'max' => 7],
            [['panchayat_code'], 'string', 'max' => 12],
            [['marking'],'safe'],
             [['captcha'],'captcha','on'=>'guestentry'],
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
            'village' => Yii::t('app', 'Village'),
            'block_code' => Yii::t('app', 'Block'),
            'panchayat_code' => Yii::t('app', 'Panchayat'),
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
		   
									
case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'hindiinput form-control']);
			    
			    break;
									
			case 'fname':
			   return  $form->field($this,$attribute)->textInput(['class'=>'hindiinput form-control']);
			    
			    break;

									
			   case 'gender':
			   return  $form->field($this,$attribute)->radioList(['M'=>'Male','F'=>'Female']);
			    
			    break;
			
									
									
			
				case 'mobileno':
			   return  $form->field($this,$attribute)->textInput(['size'=>10]);
			    
			    break;						
			case 'district_code':
			  $url1="'".Yii::getAlias('@web')."/jsons/'+$(this).val()+'.json'";
			   $id1='complaint-block';
			   
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->all(),"code","name_en"),["prompt"=>"None..",
			   'onChange'=>'populateDropdown('.$url1.",'".$id1."')",'class'=>'form-control']);
			    
			    break;
			  
			    					
			case 'address':
			   return  $form->field($this,$attribute)->textArea(['class'=>'hindiinput form-control']);
			    
			    break;
									
									
			case 'block_code':
			   $url="'".Yii::getAlias('@web')."/jsons/'+$(this).val()+'.json'";
			   $id='complaint-panchayat';
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->where(['district_code'=>$this->district_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#block-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control','id'=>'complaint-block']);
			    
			    break;
									
			case 'panchayat_code':
			   return  
			   $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Panchayat::find()->asArray()->where(['block_code'=>$this->block_code])->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",'id'=>'complaint-panchayat',
			  'onChange'=>"$('#panchayat-name').val($('option:selected',this).text());",'class'=>'form-control']);
			    
			    break;
			case 'panchayat':
			   return  
			   $form->field($this,$attribute)->hiddenInput(['id'=>'panchayat-name'])->label(false);
			    break;				
			case 'village':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'author':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'create_time':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'update_time':
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
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'fname':
			   return $this->fname;			    break;
									
			case 'mobileno':
			   return $this->mobileno;			    break;
									
			case 'address':
			   return $this->address;			    break;
									
			case 'gender':
			   return $this->gender;			    break;
									
			case 'district_code':
			   return $this->district_code;			    break;
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'panchayat_code':
			   return $this->panchayat_code;			    break;
									
			case 'village':
			   return $this->village;			    break;
									
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
    public function count1($ms=0,$d=-1,$s=-1,$count=true)
    {
       $query = new Query;
	    $query  ->select('jobcarddemand.id as id,jobcarddemand.name_hi as cname,fname,mobileno,address,panchayat,district.name_en as districtname,
	    block.name_en as blockname,
	    dateofmarking,jobcarddemand.status as status,marking.id as markingid,marking.status as markingstatus') 
	        ->from('jobcarddemand')
	        ->join(  'LEFT JOIN',
	                'marking',
	                'marking.request_id =jobcarddemand.id and marking.request_type=\'jobcarddemand\''
	            )
	           ->join(  'INNER JOIN',
	                'district',
	                'jobcarddemand.district_code =district.code'
	            ) 
	             ->join(  'INNER JOIN',
	                'block',
	                'jobcarddemand.block_code =block.code'
	            );
  
   if($s!=-1) $query->where(['status'=>$s]);
   if ($ms=='-2')
      $query->andWhere(['marking.status'=>null]);
    else 
      $query->andWhere(['marking.status'=>$ms]);
	if ($d!=-1)
	 {
	   $d=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
  
       $query->andWhere(['receiver'=>$d]);
    }
        $dp= new ActiveDataProvider([
         'query' => $query,
        
        ]);
        if ($count)
        return $dp->totalCount;
        else 
         return $dp;
         
    
    }
	
}
