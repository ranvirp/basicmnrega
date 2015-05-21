<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "marking".
 *
 * @property integer $id
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
            [['dateofmarking', 'deadline'], 'safe']
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
			   return Request::findOne($this->request_id)->$name;			    break;
									
			case 'sender':
			   return $this->sender;			    break;
									
			case 'receiver':
			   return $this->receiver;			    break;
									
			case 'dateofmarking':
			   return $this->dateofmarking;			    break;
									
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
	
}
