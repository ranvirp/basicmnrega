<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "parameter".
 *
 * @property integer $id
 * @property integer $type
 * @property string $link
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 * @property integer $weight
 * @property string $unit
 *
 * @property ParameterValue[] $parameterValues
 * @property ParameterTarget[] $parameterTargets
 */
class Parameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'weight'], 'integer'],
            [['link', 'name_hi', 'name_en', 'description', 'unit','shortcode'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'link' => 'Link',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'description' => 'Description',
            'weight' => 'Weight',
            'unit' => 'Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameterValues()
    {
        return $this->hasMany(ParameterValue::className(), ['parameter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameterTargets()
    {
        return $this->hasMany(ParameterTarget::className(), ['parameter_id' => 'id']);
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
									
			case 'type':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'link':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'hindiinput form-control']);
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
			    case 'shortcode':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'weight':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'unit':
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
									
			case 'type':
			   return $this->type;			    break;
									
			case 'link':
			   return $this->link;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'weight':
			   return $this->weight;			    break;
									
			case 'unit':
			   return $this->unit;			    break;
			 
			default:
			break;
		  }
    }
	
}
