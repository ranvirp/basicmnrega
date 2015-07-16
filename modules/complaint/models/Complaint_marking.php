<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "complaint_marking".
 *
 * @property integer $id
 * @property integer $complaint_id
 * @property integer $sender
 * @property integer $receiver
 * @property string $dateofmarking
 * @property string $deadline
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $read_time
 */
class Complaint_marking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint_marking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_id', 'sender', 'receiver', 'status', 'create_time', 'update_time', 'read_time'], 'integer'],
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
            'complaint_id' => 'Complaint ID',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'dateofmarking' => 'Dateofmarking',
            'deadline' => 'Deadline',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'read_time' => 'Read Time',
        ];
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaint()
    {
        return $this->hasOne(Complaint::className(), ['id' => 'complaint_id']);
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
									
			case 'complaint_id':
			   return  $form->field($this,$attribute)->textInput();
			    
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
									
			case 'status':
			   return  $form->field($this,$attribute)->textInput();
			    
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
									
			case 'complaint_id':
			   return $this->complaint_id;			    break;
									
			case 'sender':
			   return $this->sender;			    break;
									
			case 'receiver':
			   return $this->receiver;			    break;
									
			case 'dateofmarking':
			   return $this->dateofmarking;			    break;
									
			case 'deadline':
			   return $this->deadline;			    break;
									
			case 'status':
			   return $this->status;			    break;
									
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
