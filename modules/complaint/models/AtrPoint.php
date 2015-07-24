<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "atr_point".
 *
 * @property integer $id
 * @property integer $complaint_point_id
 * @property string $atrstatus
 * @property string $attachments
 * @property double $amountrecovered
 * @property double $amountfrom
 * @property integer $firdone
 * @property string $firdetails
 * @property integer $dadone
 * @property string $dadetails
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 */
class AtrPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atr_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_point_id', 'firdone', 'dadone', 'author', 'create_time', 'update_time'], 'integer'],
            [['atrstatus',  'amountrecovered', 'amountfrom', 'firdetails', 'dadetails'], 'string'],
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
            'complaint_point_id' => Yii::t('app', 'Complaint Point'),
            'atrstatus' => Yii::t('app', 'Status'),
            'attachments' => Yii::t('app', 'Attachments'),
            'amountrecovered' => Yii::t('app', 'Amount Recovered'),
            'amountfrom' => Yii::t('app', 'Amount Recovered From'),
            'firdone' => Yii::t('app', 'FIR Done?'),
            'firdetails' => Yii::t('app', 'If Yes, then details of FIR'),
            'dadone' => Yii::t('app', 'DA Done?'),
            'dadetails' => Yii::t('app', 'If Yes, then details of DA'),
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
									
			case 'complaint_point_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'atrstatus':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'attachments':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'amountrecovered':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'amountfrom':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firdone':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firdetails':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'dadone':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'dadetails':
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
									
			case 'complaint_point_id':
			   return $this->complaint_point_id;			    break;
									
			case 'atrstatus':
			   return $this->atrstatus;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'amountrecovered':
			   return $this->amountrecovered;			    break;
									
			case 'amountfrom':
			   return $this->amountfrom;			    break;
									
			case 'firdone':
			   return $this->firdone;			    break;
									
			case 'firdetails':
			   return $this->firdetails;			    break;
									
			case 'dadone':
			   return $this->dadone;			    break;
									
			case 'dadetails':
			   return $this->dadetails;			    break;
									
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
	
}
