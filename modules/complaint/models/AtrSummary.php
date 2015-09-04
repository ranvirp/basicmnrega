<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "atr_summary".
 *
 * @property integer $id
 * @property integer $complaint_id
 * @property string $description
 * @property string $attachments
 * @property double $amountrecovered
 * @property integer $firdone
 * @property integer $dadone
 * @property integer $author
 * @property integer $create_time
 * @property integer $update_time
 */
class AtrSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atr_summary';
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
    public function rules()
    {
        return [
            [['complaint_id', 'firdone', 'dadone', 'author', 'create_time', 'update_time'], 'integer'],
            [['description', 'amountrecovered'], 'string'],
            [['attachments'],'safe'],
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
            'description' => Yii::t('app', 'Description'),
            'attachments' => Yii::t('app', 'Attachments'),
            'amountrecovered' => Yii::t('app', 'Amount Recovered'),
            'firdone' => Yii::t('app', 'FIR Done?'),
            'dadone' => Yii::t('app', 'DA Done?'),
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
									
			case 'amountrecovered':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firdone':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'dadone':
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
									
			case 'complaint_id':
			   return $this->complaint_id;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'amountrecovered':
			   return $this->amountrecovered;			    break;
									
			case 'firdone':
			   return $this->firdone;			    break;
									
			case 'dadone':
			   return $this->dadone;			    break;
									
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
