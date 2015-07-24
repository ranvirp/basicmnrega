<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "enquiryreport_point".
 *
 * @property integer $id
 * @property integer $complaint_points_id
 * @property integer $trueorfalse
 * @property string $report
 * @property string $attachments
 * @property double $amounttoberecovered
 * @property double $amountfrom
 * @property integer $firprposed
 * @property string $firprposedreason
 * @property integer $daproposed
 * @property string $daproposeddetails
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 */
class EnquiryReportPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enquiryreport_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_point_id', 'trueorfalse', 'firproposed', 'daproposed', 'author', 'create_time', 'update_time'], 'integer'],
            [['report', 'amountfrom', 'firproposedreason', 'daproposeddetails'], 'string'],
            [['amounttoberecovered'],'double'],
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
    
     public function getComplaintPoint()
    {
        return $this->hasOne(ComplaintPoint::className(), ['complaint_point_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'complaint_points_id' => Yii::t('app', 'Complaint Points ID'),
            'trueorfalse' => Yii::t('app', 'Complaint True?'),
            'report' => Yii::t('app', 'Report'),
            'attachments' => Yii::t('app', 'Attachments'),
            'amounttoberecovered' => Yii::t('app', 'Amount to be recovered'),
            'amountfrom' => Yii::t('app', 'Amount to be recovered from'),
            'firproposed' => Yii::t('app', 'FIR Proposed?'),
            'firproposedreason' => Yii::t('app', 'FIR Proposed Reason'),
            'daproposed' => Yii::t('app', 'DA Proposed?'),
            'daproposeddetails' => Yii::t('app', 'DA Proposed Details'),
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
									
			case 'complaint_points_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'trueorfalse':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'report':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'attachments':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'amounttoberecovered':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'amountfrom':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firprposed':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firprposedreason':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'daproposed':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'daproposeddetails':
			   return  $form->field($this,$attribute)->textInput();
			    
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
									
			case 'complaint_points_id':
			   return $this->complaint_points_id;			    break;
									
			case 'trueorfalse':
			   return $this->trueorfalse;			    break;
									
			case 'report':
			   return $this->report;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'amounttoberecovered':
			   return $this->amounttoberecovered;			    break;
									
			case 'amountfrom':
			   return $this->amountfrom;			    break;
									
			case 'firprposed':
			   return $this->firprposed;			    break;
									
			case 'firprposedreason':
			   return $this->firprposedreason;			    break;
									
			case 'daproposed':
			   return $this->daproposed;			    break;
									
			case 'daproposeddetails':
			   return $this->daproposeddetails;			    break;
									
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
