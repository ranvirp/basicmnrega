<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "enquiryreport_summary".
 *
 * @property integer $id
 * @property integer $complaint_id
 * @property string $description
 * @property string $attachments
 * @property integer $complainttrue
 * @property double $amountinvolved
 * @property integer $firproposed
 * @property integer $daproposed
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 */
class EnquiryReportSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enquiryreport_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_id', 'complainttrue', 'firproposed', 'daproposed', 'author', 'create_time', 'update_time'], 'integer'],
            [['description','reportby'], 'string'],
            [['amountinvolved'],'double'],
            [['description',  'reportby','marking_id'], 'required'],
          [['marking_id','complaint_id'],'unique','targetAttribute' => ['marking_id','complaint_id']],
            
             [['attachments'],'safe'],
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
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'complaint_id' => Yii::t('app', 'Complaint ID'),
            'reportby'=>Yii::t('app','Enquiry Officer'),
            'description' => Yii::t('app', 'Description'),
            'attachments' => Yii::t('app', 'Attachments'),
            'complainttrue' => Yii::t('app', 'Complaint True?'),
            'amountinvolved' => Yii::t('app', 'Amount involved'),
            'firproposed' => Yii::t('app', 'FIR Proposed?'),
            'daproposed' => Yii::t('app', 'DA Proposed?'),
            'author' => Yii::t('app', 'Author'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
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
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'attachments':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'complainttrue':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'amountinvolved':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firproposed':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'daproposed':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
			case 'reportby':
			   return  $form->field($this,$attribute)->textArea();
			    
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
									
			case 'description':
			   return $this->description;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'complainttrue':
			   return $this->complainttrue;			    break;
									
			case 'amountinvolved':
			   return $this->amountinvolved;			    break;
									
			case 'firproposed':
			   return $this->firproposed;			    break;
									
			case 'daproposed':
			   return $this->daproposed;			    break;
									
			case 'author':
			   return $this->author;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
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
