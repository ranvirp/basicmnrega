<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "enquiryreport_attributes".
 *
 * @property integer $id
 * @property integer $complaint_reply_id
 * @property integer $complainttrue
 * @property double $amountinvolved
 * @property integer $firproposed
 * @property integer $daproposed
 */
class EnquiryReportAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enquiryreport_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['complaint_reply_id', 'complainttrue', 'firproposed', 'daproposed'], 'integer'],
            [['complaint_reply_id', 'complainttrue', 'firproposed', 'daproposed'], 'required'],
            [['amountinvolved'], 'string']
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
            'amountinvolved' => Yii::t('app', 'Amountinvolved'),
            'firproposed' => Yii::t('app', 'Firproposed'),
            'daproposed' => Yii::t('app', 'Daproposed'),
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
									
			case 'amountinvolved':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'firproposed':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'daproposed':
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
									
			case 'amountinvolved':
			   return $this->amountinvolved;			    break;
									
			case 'firproposed':
			   return $this->firproposed;			    break;
									
			case 'daproposed':
			   return $this->daproposed;			    break;
			 
			default:
			break;
		  }
    }
	
}
