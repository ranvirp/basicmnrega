<?php
namespace app\modules\complaint\models;

use Yii;
use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use app\modules\mnrega\models\Panchayat;
use app\modules\mnrega\models\MarkingSearch;




/**
 * This is the model class for table "complaint".
 *
 * @property integer $id
 * @property string $name_hi
 * @property string $fname
 * @property string $mobileno
 * @property string $district_code
 * @property string $address
 * @property string $jobcardno
 * @property string $description
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $attachments
 */
class Complaint extends \yii\db\ActiveRecord
{
public $marking;
public $captcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint';
    }
    public static function source()
    {
      return 
      [
       'cmoffice'=>'CM Office',
       'shashan'=>'Government',
       'phone'=>'Phone',
       'web'=>'Web',
       'email'=>'Email',
       'mis'=>'MIS',
       'goi'=>'GOI'
      
      ];
    
    }
/**
     * @inheritdoc
     */
    public  function behaviors()
    {
        return 
        [
          [
                'class' => \app\modules\reply\behaviors\FileAttachmentBehavior::className(),
                'attribute' => 'attachments',
          ],
          [
                'class' => \app\modules\mnrega\behaviors\MarkingBehavior::className(),
                'request_type' => 'complaint',
          ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_hi', 'fname', 'mobileno', 'district_code', 'block_code', 'panchayat_code','complaint_type','complaint_subtype'], 'required'],
            [['address', 'description'], 'string'],
            [['name_hi', 'fname'], 'string', 'max' => 255],
            [['mobileno'], 'string', 'max' => 10],
            [['district_code'], 'string', 'max' => 4],
            [['jobcardno'], 'string', 'max' => 15],
            [['block_code'], 'string', 'max' => 7],
            [['panchayat_code'], 'string', 'max' => 12],
             [['panchayat'], 'string', 'max' => 100],
           
             [['attachments','marking'], 'safe'],
             [['source','manualno'],'string'],
             [['captcha'],'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_hi' => Yii::t('app', 'शिकायतकर्ता का नाम'),
            'fname' => Yii::t('app', 'पिता/पति का नाम'),
            'mobileno' => Yii::t('app', 'मोबाइल नंबर'),
            'district_code' => Yii::t('app', 'जिला'),
            'address' => Yii::t('app', 'पता'),
            'jobcardno' => Yii::t('app', 'जॉबकार्ड नंबर'),
            'description' => Yii::t('app', 'विवरण'),
            'block_code' => Yii::t('app', 'विकास खंड'),
            'panchayat_code' => Yii::t('app', 'पंचायत'),
            'attachments' => Yii::t('app', 'संग्लग्नक'),
            'complaint_type' => Yii::t('app', 'Complaint Type'),
            'complaint_subtype' => Yii::t('app', 'Complaint Subtype'),
            
        ];
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaintPoints()
    {
        return $this->hasMany(ComplaintPoint::className(), ['complaint_id' => 'id']);
    }
         /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryReportSummary()
    {
        return $this->hasOne(EnquiryReportSummary::className(), ['complaint_id' => 'id']);
    }
          /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryReportsPoint()
    {
        return $this->hasMany(EnquiryReportPoint::className(), ['complaint_point_id' => 'id'])
        ->via('complaintPoints');
   }

	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'fname':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'mobileno':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_code':
			  $url1="'".Yii::getAlias('@web')."/jsons/'+$(this).val()+'.json'";
			   $id1='complaint-block';
			   
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'populateDropdown('.$url1.",'".$id1."')",'class'=>'form-control']);
			    
			    break;
			  
			    					
			case 'address':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'jobcardno':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
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
			case 'attachments':
			   return  
			
		$form->field($this,$attribute)->widget(\app\modules\reply\widgets\FileWidget::classname());
			    
			    break;
			    case 'source':
			    if (Yii::$app->user->isGuest)
			    return $form->field($this,$attribute)->hiddenInput(['value'=>'web'])->label(false);
			    else
			   return  $form->field($this,$attribute)->dropDownList(self::source());
			    
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
									
			case 'district_code':
			   return $this->district_code;			    break;
									
			case 'address':
			   return $this->address;			    break;
									
			case 'jobcardno':
			   return $this->jobcardno;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'panchayat_code':
			   return $this->panchayat_code;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
			case 'complaint_type':
			   return Complaint_type::findOne($this->complaint_type)->name_hi;			    break;
									
			case 'complaint_subtype':
			   return Complaint_subtype::findOne($this->complaint_subtype)->name_hi;			    break;
			
			 
			default:
			break;
		  }
    }
   
	public function getView()
    {
      return $this->name_hi;
    }
    public function _createMarking()
    {
       if (!Yii::$app->user->can('complaintmarking'))
	      return;
	     //Now create markings
	    $markings=$this->marking;
	    //  print_r($markings);
	     // exit;
       
        $maintype=Yii::$app->request->post('maintype');
        $deadline=$markings['deadline'];
        foreach ($maintype as $x)
            {
                switch ($x)
                    {
                       case 'po':
                       if (!Yii::$app->user->can('marktopo'))
                            break;
                        //find block -
                           $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid,'level_id'=>$this->block_code])->one()->id;
                           $this->markToDesignation($this->id,$designation,$deadline);
                         break;
                         case 'sqm':
                          if (!Yii::$app->user->can('marktosqm'))
                            break;
                        //find block -
                           $sqmdt=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'sqm'])->one();
                           if(!$sqmdt) break;
                           $sqmdtid=$podt->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$sqmdtid,'level_id'=>$event->sender->district_code])->one()->id;
                            $this->markToDesignation($this->id,$designation,$deadline);
                         break;
                         default: break;
                        }
            }
        if(!Yii::$app->user->can('marktodesignation')) return;
        if (!array_key_exists('designation',$markings) )return;
                foreach ($markings['designation'] as $x=>$designation_id)
                    {
                        $this->markToDesignation($this->id,$designation,$deadline);
                  
                    }
        
       
    }
}
