<?php
namespace app\modules\mnrega\models;
use Yii;
use yii\base\Model;

class RequestForm extends Model 
{
 public $request_type_id;
 public $request_content;
 public $request_subject;
 public $attachments;
 public $marking_to;
 public $deadline;
 public $_tags;
 public function rules()
 {
   return [
   [['request_type_id','request_content','attachments','marking_to'],'required'],
   ['request_type_id','integer'],
   [['request_subject','deadline'],'safe'],
   ];
 }
 public function createRequest()
  {
   if ($this->validate())
   {
     $request = new Request;
     $request->request_type_id=$this->request_type_id;
     $request->request_subject=$this->request_subject;
     $request->content=$this->request_content;
     $request->attachments=implode(",",$this->attachments);
     $request->author_id=Yii::$app->user->id;
     $request->create_time=time();
     $request->update_time=time();
     $request->attachBehavior("tagging","\\app\\modules\\taxonomy\\behaviors\\TaggingBehavior");
     $request->term_prefix='_requesttags';
     $request->save();
   
   $marking = new Marking;
   $marking->sender=\app\modules\users\models\Designation::find()
   ->where(['officer_userid'=>Yii::$app->user->id])->one();
   $marking->receiver=$this->marking_to;
   $marking->request_id=$request->id;
   $marking->dateofmarking=date('Y-m-d');
   $marking->deadline=$this->deadline;
   $marking->create_time=time();
   $marking->update_time=time();
   $marking->status=Marking::STATUS_PENDING;
   $marking->save();
   return true;
   }
   else return false;
  
  }
  public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			
									
			case 'request_type_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(RequestType::find()->asArray()->all(),"id","name"),["prompt"=>"None.."]);
			    
			    break;
									
			case 'request_subject':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'request_content':
			   return  $form->field($this,$attribute)->textArea(['rows' => '6']);
			    
			    break;
									
			case 'attachments':
			   return  $form->field($this,$attribute)->widget(\app\modules\reply\widgets\FileWidget::classname());
			  case 'marking_to':
			   return  $form->field($this,$attribute)->widget(\app\modules\users\widgets\DesignationWidget::classname());
			  
			    break;
				case 'deadline':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
								
			
			default:
			break;
		  }
    }
}