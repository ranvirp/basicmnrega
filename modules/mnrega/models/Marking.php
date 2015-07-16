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
   const STATUS_PENDING=0;
   const STATUS_DISPOSED=1;
   public static function mapping()
    {
     return [
               'jobdemand'=>'\app\modules\complaint\models\jobdemand',
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
            [['dateofmarking', 'deadline','request_type'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'dateofmarking' => 'Dateofmarking',
            'deadline' => 'Deadline',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'read_time' => 'Read Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
    public function getComplaint()
    {
       if ($this->request_type=='complaint')
       return Complaint::find()->where(['id'=>$this->request_id]);
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
			   return $this->status==0?'Pending':'Solved';
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
