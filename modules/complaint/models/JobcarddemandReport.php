<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "jobcarddemand_report".
 *
 * @property integer $id
 * @property integer $jobcarddemand_id
 * @property string $jobcardno
 * @property string $datefrom
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 * @property string $description
 * @property string $complainttrue
 */
class JobcarddemandReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jobcarddemand_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jobcarddemand_id', 'author', 'create_time', 'update_time'], 'integer'],
            [['jobcardno'], 'required','when'=>function($model){return $model->complainttrue==1;}],
            [['datefrom'], 'safe'],
            [['description'], 'string'],
            [['jobcardno'], 'string', 'max' => 255],
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
            'jobcarddemand_id' => Yii::t('app', 'Jobcarddemand ID'),
            'jobcardno' => Yii::t('app', 'Jobcardno'),
            'datefrom' => Yii::t('app', 'Datefrom'),
            'author' => Yii::t('app', 'Author'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'description' => Yii::t('app', 'Description'),
            'complainttrue' => Yii::t('app', 'Complainttrue'),
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
									
			case 'jobcarddemand_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'jobcardno':
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
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'complainttrue':
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
									
			case 'jobcarddemand_id':
			   return $this->jobcarddemand_id;			    break;
									
			case 'jobcardno':
			   return $this->jobcardno;			    break;
									
			case 'datefrom':
			   return $this->datefrom;			    break;
									
			case 'author':
			   return $this->author;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'complainttrue':
			   return $this->complainttrue;			    break;
			 
			default:
			break;
		  }
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
