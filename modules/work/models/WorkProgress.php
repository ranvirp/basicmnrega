<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "work_progress".
 *
 * @property integer $id
 * @property integer $work_id
 * @property double $exp
 * @property integer $phy
 * @property integer $fin
 */
class WorkProgress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_progress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id', 'phy', 'fin'], 'integer'],
            [['exp'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_id' => 'Work ID',
            'exp' => 'Exp',
            'phy' => 'Phy',
            'fin' => 'Fin',
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
									
			case 'work_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'exp':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'phy':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'fin':
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
									
			case 'work_id':
			   return $this->work_id;			    break;
									
			case 'exp':
			   return $this->exp;			    break;
									
			case 'phy':
			   return $this->phy;			    break;
									
			case 'fin':
			   return $this->fin;			    break;
			 
			default:
			break;
		  }
    }
	
}
