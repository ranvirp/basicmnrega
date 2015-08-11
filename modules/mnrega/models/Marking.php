<?php
namespace app\modules\mnrega\models;
use app\modules\users\models\Designation;
use app\modules\complaint\models\Complaint;

use Yii;

/**
 * This is the model class for table "marking".
 *
 * @property integer $id
 * @property integer $request_type
 * @property integer $request_id
 * @property integer $sender
 * @property integer $receiver
 * @property string $dateofmarking
 * @property string $deadline
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $read_time
 * @property integer status
 * @property Request $request
 */
class Marking extends \yii\db\ActiveRecord
{
   const FLAG_PENDING=0;
   const FLAG_DISPOSED=1;
   const FLAG_ALERT=2;
   public static function mapping()
    {
     return [
               'jobcarddemand'=>'\app\modules\complaint\models\jobcarddemand',
               'workdemand'=>'\app\modules\complaint\models\workdemand',
               'complaint'=>'\app\modules\complaint\models\complaint',
            ];
                
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'sender', 'receiver', 'create_time', 'update_time', 'read_time'], 'integer'],
            [['dateofmarking', 'deadline','request_type'], 'safe'],
            [['status','statustarget','receiver_designation_type_id'],'integer'],
             [['receiver_mobileno','sender_mobileno','sender_designation_type_id'],'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
             'request_type' => Yii::t('app','request_type'),
            'request_id' => Yii::t('app','ID'),
            'sender' => Yii::t('app','Sender'),
            'receiver' => Yii::t('app','Receiver'),
            'dateofmarking' => Yii::t('app','Date of Marking'),
            'deadline' => Yii::t('app','Deadline'),
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'read_time' => 'Read Time',
        ];
    }


    public function getComplaint()
    {
       $classmapping=self::mapping();
       $class=$classmapping[$this->request_type];
       return $class::find()->where(['id'=>$this->request_id]);
        
     }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver1()
    {
        return $this->hasOne(Designation::className(), ['id' => 'receiver']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender1()
    {
        return $this->hasOne(Designation::className(), ['id' => 'sender']);
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
									
			case 'request_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Request::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'sender':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'receiver':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'dateofmarking':
			   return  
			             $form->field($this, "dateofmarking")->widget(\kartik\widgets\DatePicker::classname(), [
'options' => ['placeholder' => 'Enter'. $this->attributeLabels()["dateofmarking"]." ..."],
'pluginOptions' => [
'autoclose'=>true
]
]); 			    
			    break;
									
			case 'deadline':
			   return  
			             $form->field($this, "deadline")->widget(\kartik\widgets\DatePicker::classname(), [
'options' => ['placeholder' => 'Enter'. $this->attributeLabels()["deadline"]." ..."],
'pluginOptions' => [
'autoclose'=>true
]
]); 			    
			    break;
									
			case 'create_time':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'update_time':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'read_time':
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
									
			case 'request_id':
			   return $this->request_id;			    break;
									
			case 'sender':
			   $designation=Designation::findOne($this->sender);
			   if ($designation)
			     return $designation->name_en;
			    else
			      return $this->sender;
			   break;
									
			case 'receiver':
			   $designation=Designation::findOne($this->receiver);
			   if ($designation)
			     return $designation->name_en;
			    else
			      return $this->receiver;break;
									
			case 'dateofmarking':
			   return $this->dateofmarking;			    break;
			case 'status':
			   $classmapping= self::mapping();
			   $class=$classmapping[$this->request_type];
			   $statuses=$class::statusNames();
			   return $statuses[$this->status];
			   //return $this->status==0?'Pending':'Solved';
			   break;
									
			case 'deadline':
			   return $this->deadline;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
									
			case 'read_time':
			   return $this->read_time;			    break;
			 
			default:
			break;
		  }
    }
    public function getView()
    {
      return $this->id;
    }
     public static function count1($t,$status,$d=-1)
     
      {
        if(count($t)==0) return;//nothing to do
         if(count($status)==0) 
          {
           $status=['0'];
          }
        $q=[];
        foreach ($t as $tc)
        {
        // print_r($status);
         //exit;
         foreach ($status as $s1)
          {
          $x="SUM(CASE WHEN marking.flag!=1 AND marking.status=".$s1." and request_type='".$tc."'";
          if ($d!=-1) $x.="and receiver=".$d;
          $q[]=$x." THEN 1 ELSE 0 END) AS ".$tc."_count"."_".$s1;
          }
          $x="SUM(CASE WHEN marking.flag!=1 AND request_type='".$tc."'";
           if ($d!=-1) $x.="and receiver=".$d;

          $q[]=$x." THEN 1 ELSE 0 END) AS ".$tc."_count";
         
        }
        $query="SELECT ".implode(",",$q)." FROM marking";
        //inner join ".$tc." on marking.request_type='".
         // $tc."' and marking.status=".$tc.".status";
        $db=Yii::$app->db;
        $counts= $db->createCommand($query)->queryAll();
         
        /*
        $counts=$db->cache(function($db,$query)
          {
          $db->createCommand($query)->queryAll();
            });
            */
        return $counts;
          
        /*
        http://stackoverflow.com/questions/12693111/count-multiple-columns-with-group-by-in-one-query
       SELECT 
     SUM(CASE WHEN column1 IS NOT NULL THEN 1 ELSE 0 END) AS column1_count
    ,SUM(CASE WHEN column2 IS NOT NULL THEN 1 ELSE 0 END) AS column2_count
    ,SUM(CASE WHEN column3 IS NOT NULL THEN 1 ELSE 0 END) AS column3_count
    FROM table
    */
      /*
        $modelSearch= new MarkingSearch;
         //$designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
         //$d=$designation->id;
        $modelSearch->request_type=$t;
        if ($d==-1)
          $modelSearch->receiver=$d;
        $modelSearch->status=$s;
       $dp=$modelSearch->search([]);
       return $dp->totalCount;
       */
       
    }
    public static function countflag($t,$flags,$d=-1)
     
      {
        if(count($t)==0) return;//nothing to do
         if(count($flags)==0) 
          {
           $status=['0'];
          }
        $q=[];
        foreach ($t as $tc)
        {
        // print_r($status);
         //exit;
         foreach ($flags as $flag)
          {
          $x="SUM(CASE WHEN marking.flag=".$flag." and request_type='".$tc."'";
          if ($d!=-1) $x.="and receiver=".$d;
          $q[]=$x." THEN 1 ELSE 0 END) AS ".$tc."_count"."_".$flag;
          }
          $x="SUM(CASE WHEN request_type='".$tc."'";
           if ($d!=-1) $x.="and receiver=".$d;

          $q[]=$x." THEN 1 ELSE 0 END) AS ".$tc."_count";
         
        }
        $query="SELECT ".implode(",",$q)." FROM marking";
        //inner join ".$tc." on marking.request_type='".
         // $tc."' and marking.status=".$tc.".status";
        $db=Yii::$app->db;
        $counts= $db->createCommand($query)->queryAll();
         
        /*
        $counts=$db->cache(function($db,$query)
          {
          $db->createCommand($query)->queryAll();
            });
            */
        return $counts;
    
       
    }
    public static function setStatus($markingid,$status,$message='')
    {
       $marking=Marking::findOne($markingid);
       
       if ($marking)
         {
           $marking->status=$status;
           $marking->save();
         }
         
       
    
    }
    /*
    public function show($request_type,$request_id)
    {
      $marking=new MarkingSearch;
      $marking->request_type=$request_type;
      $marking->request_id=$request_id;
      $dp =$marking->search([]);
      return yii\base\Controller::renderPartial('index',['dataProvider'=>$dp,'searchModel'=>$marking]);
    }
    */
	
}
