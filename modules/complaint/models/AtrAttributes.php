<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "atr_attributes".
 *
 * @property integer $id
 * @property integer $complaint_reply_id
 * @property integer $complainttrue
 * @property integer $firdone
 * @property integer $dadone
 * @property double $amountrecovered
 */
class AtrAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atr_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_reply_id', 'complainttrue', 'firdone', 'dadone'], 'integer'],
             [['complaint_reply_id', 'complainttrue', 'firdone', 'dadone'], 'required'],
            [['amountrecovered'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'complaint_reply_id' => Yii::t('app', 'Complaint Reply ID'),
            'complainttrue' => Yii::t('app', 'Complainttrue'),
            'firdone' => Yii::t('app', 'Firdone'),
            'dadone' => Yii::t('app', 'Dadone'),
            'amountrecovered' => Yii::t('app', 'Amountrecovered'),
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
									
			case 'complaint_reply_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'complainttrue':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firdone':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'dadone':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'amountrecovered':
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
									
			case 'complaint_reply_id':
			   return $this->complaint_reply_id;			    break;
									
			case 'complainttrue':
			   return $this->complainttrue;			    break;
									
			case 'firdone':
			   return $this->firdone;			    break;
									
			case 'dadone':
			   return $this->dadone;			    break;
									
			case 'amountrecovered':
			   return $this->amountrecovered;			    break;
			 
			default:
			break;
		  }
    }
	
}
