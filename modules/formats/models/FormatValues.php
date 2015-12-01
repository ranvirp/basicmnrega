<?php
namespace app\modules\formats\models;

use Yii;

/**
 * This is the model class for table "format_values".
 *
 * @property integer $id
 * @property string $format_id
 * @property integer $created_by
 * @property string $finyear
 * @property string $scheme
 * @property string $district
 * @property integer $month
 * @property string $enteredvalues
 * @property string $calcvalues
 */
class FormatValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'format_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'finyear'], 'required'],
            [['created_by', 'month'], 'integer'],
            [['enteredvalues', 'calcvalues'], 'string'],
            [['format_id', 'finyear', 'scheme', 'district'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'format_id' => 'Format ID',
            'created_by' => 'Created By',
            'finyear' => 'Finyear',
            'scheme' => 'Scheme',
            'district' => 'District',
            'month' => 'Month',
            'enteredvalues' => 'Values',
            'calcvalues' => 'Calcvalues',
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
									
			case 'format_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'created_by':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'finyear':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'scheme':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'month':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'enteredvalues':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'calcvalues':
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
									
			case 'format_id':
			   return $this->format_id;			    break;
									
			case 'created_by':
			   return $this->created_by;			    break;
									
			case 'finyear':
			   return $this->finyear;			    break;
									
			case 'scheme':
			   return $this->scheme;			    break;
									
			case 'district':
			   return $this->district;			    break;
									
			case 'month':
			   return $this->month;			    break;
									
			case 'enteredvalues':
			   return $this->values;			    break;
									
			case 'calcvalues':
			   return $this->calcvalues;			    break;
			 
			default:
			break;
		  }
    }
	
}
