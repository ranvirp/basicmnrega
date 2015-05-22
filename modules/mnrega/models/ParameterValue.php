<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "parameter_value".
 *
 * @property integer $id
 * @property integer $parameter_id
 * @property string $district_id
 * @property string $parameter_value
 * @property integer $update_time
 *
 * @property Parameter $parameter
 */
class ParameterValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameter_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter_id', 'update_time'], 'integer'],
            [['district_id', 'parameter_value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parameter_id' => 'Parameter ID',
            'district_id' => 'District ID',
            'parameter_value' => 'Parameter Value',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameter()
    {
        return $this->hasOne(Parameter::className(), ['id' => 'parameter_id']);
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
									
			case 'parameter_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Parameter::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'district_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'parameter_value':
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
									
			case 'parameter_id':
			   return Parameter::findOne($this->parameter_id)->$name;			    break;
									
			case 'district_id':
			   return $this->district_id;			    break;
									
			case 'parameter_value':
			   return $this->parameter_value;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
			default:
			break;
		  }
    }
	
}
