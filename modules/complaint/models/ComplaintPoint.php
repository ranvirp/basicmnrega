<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "complaint_point".
 *
 * @property integer $id
 * @property integer $complaint_id
 * @property string $complaint_type
 * @property string $complaint_subtype
 * @property string $description
 * @property string $attachments
 */
class ComplaintPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_id'], 'integer'],
            [['description'], 'string'],
            [['attachments','id'],'safe'],
            [['complaint_type', 'complaint_subtype'], 'string', 'max' => 10]
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
        ];
    }
public function getEnquiryReportPoint()
{
 return $this->hasOne(EnquiryReportPoint::className(),'complaint_point_id','id');
}
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'complaint_id' => Yii::t('app', 'Complaint ID'),
            'complaint_type' => Yii::t('app', 'Complaint Type'),
            'complaint_subtype' => Yii::t('app', 'Complaint Subtype'),
            'description' => Yii::t('app', 'Description'),
            'attachments' => Yii::t('app', 'Attachments'),
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
									
			case 'complaint_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'complaint_type':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'complaint_subtype':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'attachments':
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
									
			case 'complaint_type':
			   return Complaint_type::findOne($this->complaint_type)->name_hi;			    break;
									
			case 'complaint_subtype':
			   return Complaint_subtype::findOne($this->complaint_subtype)->name_hi;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
			 
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
