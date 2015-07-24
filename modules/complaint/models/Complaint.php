<?php
namespace app\modules\complaint\models;

use Yii;
use app\modules\mnrega\models\District;
use app\modules\mnrega\models\Block;
use app\modules\mnrega\models\Panchayat;
use app\modules\mnrega\models\MarkingSearch;
use app\modules\mnrega\models\Marking;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;




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
const REGISTERED=0;
const PENDING_FOR_ENQUIRY=1;
const ENQUIRY_REPORT_RECEIVED=2;
const PENDING_FOR_ATR=3;
const ATR_RECEIVED=4;
const DISPOSED=5;
public static function statusNames()
{
 return 
   [
     self::REGISTERED=>Yii::t('app','Registered'),
     self::PENDING_FOR_ENQUIRY=>Yii::t('app','Pending for enquiry'),
     self::ENQUIRY_REPORT_RECEIVED=>Yii::t('app','Enquiry report recieved'),
     self::PENDING_FOR_ATR=>Yii::t('app','Pending for atr'),
     self::ATR_RECEIVED=>Yii::t('app','Atr received'),
     self::DISPOSED=>Yii::t('app','disposed'),
   ];
 

}
/*
 from web, registered -----next mark to officer and change to pending for enquiry
 pending for enquiry--enquiry report received 
 
 

*

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
       'shashan'=>'Shashan',
       'ayukt'=>'Ayukt',
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
            [['name_hi',  'mobileno', 'district_code',  'complaint_type'], 'required'],
            [['address', 'description','fname','block_code','panchayat_code'], 'string'],
            [['name_hi', 'fname'], 'string', 'max' => 255],
            [['mobileno'], 'string', 'max' => 10],
            [['district_code'], 'string', 'max' => 4],
            [['jobcardno'], 'string', 'max' => 15],
            [['block_code'], 'string', 'max' => 7],
            [['panchayat_code'], 'string', 'max' => 12],
             [['panchayat'], 'string', 'max' => 100],
           
             [['attachments','marking'], 'safe'],
             [['source','manualno'],'string'],
             [['flag','created_by','created_at','updated_by','updated_at'],'integer'],
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
            'name_hi' => Yii::t('app', 'शिकायतकर्ता का नाम'),
            'fname' => Yii::t('app', 'पिता/पति का नाम'),
            'mobileno' => Yii::t('app', 'मोबाइल नंबर'),
            'district_code' => Yii::t('app', 'जिला'),
            'address' => Yii::t('app', 'पता'),
            'jobcardno' => Yii::t('app', 'जॉबकार्ड नंबर'),
            'description' => Yii::t('app', 'विवरण'),
            'block_code' => Yii::t('app', 'विकास खंड'),
            'panchayat_code' => Yii::t('app', 'पंचायत'),
            'panchayat'=>Yii::t('app','Panchayat'),
            'gender'=>Yii::t('app','Gender'),
            
            'attachments' => Yii::t('app', 'संग्लग्नक'),
            'complaint_type' => Yii::t('app', 'Complaint Type'),
            'complaint_subtype' => Yii::t('app', 'Complaint Subtype'),
            
        ];
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarkings()
    {
        return $this->hasMany(Marking::className(), ['request_id' => 'id'])->where(['request_type'=>'complaint','marking.status'=>'0'])->with('receiver1');
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtrSummary()
    {
        return $this->hasOne(AtrSummary::className(), ['complaint_id' => 'id']);
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
          /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtrPoints()
    {
        return $this->hasMany(AtrPoint::className(), ['complaint_point_id' => 'id'])
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
			   
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->orderBy('name_en asc')->asArray()->all(),"code","name_en"),["prompt"=>"None..",
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
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->where(['district_code'=>$this->district_code])->all(),"code","name_en"),["prompt"=>"None..",
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
			    case 'manualno':
			     if (Yii::$app->user->isGuest)
			    return '';
			    else
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
        $flag=false;
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
                           $flag=true;
                         break;
                         case 'cdo':
                       if (!Yii::$app->user->can('marktopo'))
                            break;
                        //find block -
                           $cdodtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'cdo'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$cdodtid,'level_id'=>$this->district_code])->one()->id;
                           $this->markToDesignation($this->id,$designation,$deadline);
                           $flag=true;
                         break;
                            case 'dcmnrega':
                       if (!Yii::$app->user->can('marktopo'))
                            break;
                        //find block -
                           $dcmnregadtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'dcmnrega'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$dcmnregadtid,'level_id'=>$this->district_code])->one()->id;
                           $this->markToDesignation($this->id,$designation,$deadline);
                           $flag=true;
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
                            $flag=true;
                         break;
                         default: break;
                        }
            }
        if(Yii::$app->user->can('marktoothers')) {
        if (array_key_exists('designation',$markings) )
          {
                foreach ($markings['designation'] as $x=>$designation_id)
                    {
                        $this->markToDesignation($this->id,$designation_id,$deadline);
                        $flag=true;
                  
                    }
            }
            }
        if ($flag)
          {
            if ($this->status==self::REGISTERED)
             {
               $this->status=self::PENDING_FOR_ENQUIRY;
              }
            else 
              if ($this->status==self::ENQUIRY_REPORT_RECEIVED)
              $this->status=self::PENDING_FOR_ATR;
          }
       
    }
    public function count1($ms=0,$d=-1,$s=-1,$count=true,$dcode=null,$bcode=null)
    {
       $query = new Query;
	    $query  ->select('complaint.id as id,complaint.name_hi as cname,fname,mobileno,address,panchayat,
	    complaint_type.name_hi as ctype,complaint_subtype.name_hi as csubtype,complaint.description as desc,dateofmarking,complaint.status as complaintstatus,marking.id as markingid,marking.status as markingstatus,district_code,block_code') 
	        ->from('complaint')
	        ->join(  'LEFT JOIN',
	                'marking',
	                'marking.request_id =complaint.id and marking.request_type=\'complaint\''
	            )
	           ->join(  'LEFT JOIN',
	                'complaint_type',
	                'complaint.complaint_type =complaint_type.shortcode'
	            ) 
	             ->join(  'LEFT JOIN',
	                'complaint_subtype',
	                'complaint.complaint_subtype =complaint_subtype.shortcode'
	            );
  
   if($s!=-1) $query->where(['complaint.status'=>$s]);
   
   if ($ms==-2)
      $query->andWhere(['marking.status'=>null]);
    else 
     if ($ms!=-1)
      $query->andWhere(['marking.status'=>$ms]);
    if ($dcode)
       $query->andWhere(['complaint.district_code'=>$dcode]);
    if ($bcode)
       $query->andWhere(['complaint.block_code'=>$bcode]);
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
     public function _search($mobileno)
    {
      $models=Complaint::find()->where(['mobileno'=>$mobileno])->asArray()->all(); 
      return json_encode($models);
    }
     public static function setStatus($id,$status,$message='')
    {
       $complaint=Complaint::findOne($id);
       $transaction=\Yii::$app->db->beginTransaction();
       if ($complaint)
         {
           $complaint->status=$status;
           $complaint->save();
         }
         if ($message!='')
         {
           $reply=new \app\modules\reply\models\Reply;
           $reply->content_type='complaint';
           $reply->content_type_id=$complaint->id;
           $reply->author_id=Yii::$app->user->id;
           $reply->create_time=time();
           $reply->save();
         
         }
        $transaction->commit();
    
    }
    public static function getButton($id,$type)
    {
      if ($type=='acceptatr')
       
         return '<button class="btn btn-success" onclick="$.get(\''.Url::to(['/complaint/complaint/setStatus?id='.$id.'&status='.self::DISPOSED])."')>Accept ATR</button>";
      else if ($type=='acceptenquiryreport')
                   return '<button class="btn btn-success" onclick="$.get(\''.Url::to(['/complaint/complaint/setstatus?id='.$id.'&status='.self::PENDING_FOR_ATR])."')\">Accept Enquiry Report</button>";
  
        else if ($type=='rejectenquiryreport')
                    return '<button class="btn btn-success" onclick="$.get(\''.Url::to(['/complaint/complaint/setstatus?id='.$id.'&status='.self::PENDING_FOR_ENQUIRY])."')\">Reject Enquiry Report</button>";
  
     else if ($type=='rejectatr')
                    return '<button class="btn btn-success" onclick="$.get(\''.Url::to(['/complaint/complaint/setstatus?id='.$id.'&status='.self::PENDING_FOR_ATR])."')\">Reject Enquiry Report</button>";
  
    }
     /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        $x=[];
        foreach ($this->attributes as $name=>$attribute)
         {
          $x[$name]=Yii::t('hints',self::tableName().'_'.$name.'_hint');
         }
       return array_merge(parent::attributeHints(), $x);
    }

}
