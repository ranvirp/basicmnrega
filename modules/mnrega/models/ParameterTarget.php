<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "parameter_target".
 *
 * @property integer $id
 * @property integer $parameter_id
 * @property string $district_id
 * @property string $parameter_target
 * @property integer $month
 *
 * @property Parameter $parameter
 */
class ParameterTarget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameter_target';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter_id', 'month'], 'integer'],
            [['district_id', 'parameter_target'], 'string', 'max' => 255]
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
            'parameter_target' => 'Parameter Target',
            'month' => 'Month',
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
									
			case 'parameter_target':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'month':
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
									
			case 'parameter_target':
			   return $this->parameter_target;			    break;
									
			case 'month':
			   return $this->month;			    break;
			 
			default:
			break;
		  }
    }
	
}
