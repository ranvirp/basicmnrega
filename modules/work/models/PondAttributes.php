<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "pond_attributes".
 *
 * @property string $workid
 * @property string $gatanumber
 * @property string $estpersondays
 * @property double $totalarea
 */
class PondAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pond_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workid'], 'required'],
            [['totalarea'], 'string'],
            [['workid', 'gatanumber', 'estpersondays'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workid' => 'Workid',
            'gatanumber' => 'Gatanumber',
            'estpersondays' => 'Estpersondays',
            'totalarea' => 'Totalarea',
        ];
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'workid':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gatanumber':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'estpersondays':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'totalarea':
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
		   
									
			case 'workid':
			   return $this->workid;			    break;
									
			case 'gatanumber':
			   return $this->gatanumber;			    break;
									
			case 'estpersondays':
			   return $this->estpersondays;			    break;
									
			case 'totalarea':
			   return $this->totalarea;			    break;
			 
			default:
			break;
		  }
    }
	
}
