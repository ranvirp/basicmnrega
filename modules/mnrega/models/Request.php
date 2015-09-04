<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $request_type_id
 * @property string $request_subject
 * @property string $content
 * @property string $attachments
 * @property integer $author_id
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Marking[] $markings
 * @property RequestType $requestType
 */
class Request extends \yii\db\ActiveRecord
{
   const PENDING=0;
   const DISPOSED=1;
public static function statusNames()
{
 return 
   [
     self::PENDING=>Yii::t('app','Pending'),
     self::DISPOSED=>Yii::t('app','Disposed'),
     
   ];
 

}
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_type_id', 'author_id', 'create_time', 'update_time'], 'integer'],
            [['request_subject'], 'required'],
            [['content', 'attachments'], 'string'],
            [['request_subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_type_id' => 'Category/Type of Request',
            'request_subject' => 'Subject',
            'content' => 'Description',
            'attachments' => 'Attachments',
            'author_id' => 'Author',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarkings()
    {
        return $this->hasMany(Marking::className(), ['request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestType()
    {
        return $this->hasOne(RequestType::className(), ['id' => 'request_type_id']);
    }
      public function _createMultipleMarking($actiontype,$canmark=0)
    {
//	public function markToDesignation($request_id,$sender,$sender_name,$sender_mobileno,$designation_type_id,$designation=0,$name='',$mobileno='',$purpose,$canmark,$status,$statustarget,$deadline)

       if (!Yii::$app->user->can('complaintmarking'))
	      return;
	      $designation=Designation::getDesignationByUser(Yii::$app->user->id,true);
	      $sender=$designation->id;
          $sender_designation_type_id=$designation->designation_type_id;
          $sender_name=$designation->officer_name_en;
          $sender_mobileno=$designation->officer_mobile;
                           
	      switch($actiontype)
	      {
	        case 'enq':
	          $status=self::PENDING_FOR_ENQUIRY;
	          $statustarget=self::ENQUIRY_REPORT_ACCEPTED;
	          $purpose="For Enquiry";
	          break;
	        case 'atr':
	          $status=self::PENDING_FOR_ATR;
	          $statustarget=self::DISPOSED;
	          $purpose="For ATR";
	          break;
	         case 'enqatr':
	          $status=self::PENDING_FOR_ENQUIRY;
	          $statustarget=self::DISPOSED;
	          $purpose="For Enquiry and ATR";
	          break;
	          default:
	          $status=self::PENDING_FOR_ENQUIRY;
	          $statustarget=self::DISPOSED;
	          $purpose="For Enquiry and ATR";
	          break;
	          
	      }
	     //Now create markings
	    //  print_r($markings);
	     // exit;
       
        $maintype=Yii::$app->request->post('maintype');
        $this->load(Yii::$app->request->post());
        if (!$maintype) $maintype=[];
        $markings=$this->marking;
        //print_r($markings);
        //exit;
        $deadline=$markings['deadline'];
        if (array_key_exists('designation',$markings))
        $designations=$markings['designation'];
        else 
         $designations=[];
          if (array_key_exists('others',$markings))
        $others=$markings['others'];
        else 
        $others=null;
        
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
                           $receiver=$designation->id;
                           $receiver_designation_type_id=$designation->designation_type_id;
                           $receiver_name=$designation->officer_name_hi;
                           $receiver_mobileno=$designation->officer_mobileno;
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
                           $flag=true;
                         break;
                         case 'cdo':
                       if (!Yii::$app->user->can('marktopo'))
                            break;
                        //find block -
                           $cdodtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'cdo'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$cdodtid,'level_id'=>$this->district_code])->one()->id;
                           $receiver=$designation->id;
                           $receiver_designation_type_id=$designation->designation_type_id;
                           $receiver_name=$designation->officer_name_hi;
                           $receiver_mobileno=$designation->officer_mobileno;
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
                            $flag=true;
                         break;
                            case 'dcmnrega':
                       if (!Yii::$app->user->can('marktopo'))
                            break;
                        //find block -
                           $dcmnregadtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'dcmnrega'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$dcmnregadtid,'level_id'=>$this->district_code])->one()->id;
                           $receiver=$designation->id;
                           $receiver_designation_type_id=$designation->designation_type_id;
                           $receiver_name=$designation->officer_name_hi;
                           $receiver_mobileno=$designation->officer_mobileno;
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$designation,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
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
                           $receiver=$designation->id;
                           $receiver_designation_type_id=$designation->designation_type_id;
                           $receiver_name=$designation->officer_name_hi;
                           $receiver_mobileno=$designation->officer_mobileno;
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
                        $flag=true;
                         break;
                         case 'lokpal':
                          if (!Yii::$app->user->can('marktosqm'))
                            break;
                        //find block -
                           $sqmdt=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'lokpal'])->one();
                           if(!$sqmdt) break;
                           $sqmdtid=$podt->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$sqmdtid,'level_id'=>$event->sender->district_code])->one();
                           $receiver=$designation->id;
                           $receiver_designation_type_id=$designation->designation_type_id;
                           $receiver_name=$designation->officer_name_hi;
                           $receiver_mobileno=$designation->officer_mobileno;
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
                           $flag=true;
                         break;
                         default: break;
                        }
            }
        if(Yii::$app->user->can('marktoothers')) {
                foreach ($designations as $designation_id)
                    {
                      if (is_numeric($designation_id))
                      {
                           $designation =\app\modules\users\models\Designation::findOne($designation_id);
                           $receiver=$designation->id;
                           $receiver_designation_type_id=$designation->designation_type_id;
                           $receiver_name=$designation->officer_name_hi;
                           $receiver_mobileno=$designation->officer_mobileno;
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
                           $flag=true;
                     }
                  
                    }
            
            }
            if ($others)
            {
                           $receiver=0;
                           $receiver_designation_type_id=$others['designation_type_id'];
                           $receiver_name=$others['name'];
                           $receiver_mobileno=$others['mobileno'];
                           
                           $this->markToDesignation($this->id,$sender,$sender_name,$sender_mobileno,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline);
                           $flag=true;
                     
            
            }
        if ($flag)
          {
            if ($this->status==self::REGISTERED || $this->status==null)
             {
               $this->status=self::PENDING_FOR_ENQUIRY;
              }
            else 
              if ($this->status==self::ENQUIRY_REPORT_RECEIVED)
              $this->status=self::PENDING_FOR_ATR;
          }
       
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
									
			case 'request_type_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(RequestType::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'request_subject':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'content':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'attachments':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'author_id':
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
	    $name='name';
	    //.Yii::$app->language;
		switch ($attribute)
		  {
		   
									
			case 'id':
			   return $this->id;			    break;
									
			case 'request_type_id':
			   return RequestType::findOne($this->request_type_id)->$name;			    break;
									
			case 'request_subject':
			   return $this->request_subject;			    break;
									
			case 'content':
			   return $this->content;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'author_id':
			   return $this->author_id;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
			default:
			break;
		  }
    }
        public function _createMarking()
    {
       if (!Yii::$app->user->can('requestmarking'))
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
                           $designation=ArrayHelper::map(\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid])->asArray()->all(),'id','id');
                           $this->markToDesignation($this->id,$designations,$deadline);
                           $flag=true;
                         break;
                         case 'cdo':
                       if (!Yii::$app->user->can('marktocdo'))
                            break;
                        //find block -
                           $cdodtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'cdo'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$cdodtid,'level_id'=>$this->district_code])->one()->id;
                           $this->markToDesignation($this->id,$designation,$deadline);
                           $flag=true;
                         break;
                            case 'dcmnrega':
                       if (!Yii::$app->user->can('marktodcmnrega'))
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
                         case 'lokpal':
                          if (!Yii::$app->user->can('marktosqm'))
                            break;
                        //find block -
                           $sqmdt=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'lokpal'])->one();
                           if(!$sqmdt) break;
                           $sqmdtid=$podt->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$sqmdtid,'level_id'=>$event->sender->district_code])->one()->id;
                            $this->markToDesignation($this->id,$designation,$deadline);
                            $flag=true;
                         break;
                         case 'dm':
                       if (!Yii::$app->user->can('marktodm'))
                            break;
                        //find block -
                           $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'dm'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$dmdtid,'level_id'=>$this->district_code])->one()->id;
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
	    $query  ->select('request.id as id,request.name_hi as cname,fname,mobileno,address,panchayat,
	    complaint_type.name_hi as ctype,complaint_subtype.name_hi as csubtype,complaint.description as desc,dateofmarking,complaint.status as complaintstatus,flowtype,marking.id as markingid,marking.status as markingstatus,complaint.district_code,complaint.block_code,district.name_en as dname,block.name_en as bname') 
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
	            )->join(  'INNER JOIN',
	                'district',
	                'complaint.district_code =district.code'
	            ) 
	             ->join(  'INNER JOIN',
	                'block',
	                'complaint.block_code =block.code'
	            );
  
   if($s!=-1) $query->where(['complaint.status'=>$s]);
   
   if ($ms==-2)
      $query->andWhere(['marking.id'=>null]);
    else 
     if ($ms!=-1)
      $query->andWhere(['marking.status'=>$ms]);
    if ($dcode)
       $query->andWhere(['complaint.district_code'=>$dcode]);
    if ($bcode)
       $query->andWhere(['complaint.block_code'=>$bcode]);
	
	  if (!Yii::$app->user->can('complaintviewall') )
	  {
	   $d=\app\modules\users\models\Designation::getDesignationByUser(Yii::$app->user->id);
  
       $query->andWhere(['receiver'=>$d]);
       }
       else if($d!=-1)
         $query->andWhere(['receiver'=>$d]);   
        $dp= new ActiveDataProvider([
         'query' => $query,
        
        ]);
        if ($count)
        return $dp->totalCount;
        else 
         return $dp;
         
    
    }
	
}
