<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "workdemand_report".
 *
 * @property integer $id
 * @property integer $work_demand_id
 * @property string $work_id
 * @property string $workname
 * @property string $datefrom
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 * @property string $complainttrue
 * @property string $description
 */
class WorkdemandReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workdemand_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_demand_id', 'author', 'create_time', 'update_time'], 'integer'],
            [['work_id','workname'], 'required'],
            [['datefrom'], 'safe'],
            [['description'], 'string'],
            [['work_id', 'workname'], 'string', 'max' => 255],
            [['complainttrue'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'work_demand_id' => Yii::t('app', 'Work Demand ID'),
            'work_id' => Yii::t('app', 'Work ID'),
            'workname' => Yii::t('app', 'Workname'),
            'datefrom' => Yii::t('app', 'Datefrom'),
            'author' => Yii::t('app', 'Author'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'complainttrue' => Yii::t('app', 'Complainttrue'),
            'description' => Yii::t('app', 'Description'),
        ];
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
									
			case 'work_demand_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'work_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'workname':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'datefrom':
			   return  
			             $form->field($this, "datefrom")->widget(\kartik\widgets\DatePicker::classname(), [
'options' => ['placeholder' => 'Enter'. $this->attributeLabels()["datefrom"]." ..."],
'pluginOptions' => [
'autoclose'=>true
]
]); 			    
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
									
			case 'complainttrue':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
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
									
			case 'work_demand_id':
			   return $this->work_demand_id;			    break;
									
			case 'work_id':
			   return $this->work_id;			    break;
									
			case 'workname':
			   return $this->workname;			    break;
									
			case 'datefrom':
			   return $this->datefrom;			    break;
									
			case 'author':
			   return $this->author;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
									
			case 'complainttrue':
			   return $this->complainttrue;			    break;
									
			case 'description':
			   return $this->description;			    break;
			 
			default:
			break;
		  }
    }
	
}
