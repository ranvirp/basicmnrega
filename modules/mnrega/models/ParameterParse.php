<?php
namespace app\modules\mnrega\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "parameter_parse".
 *
 * @property integer $id
 * @property integer $parameter_id
 * @property string $json_value
 * @property integer $update_time
 *
 * @property Parameter $parameter
 */
class ParameterParse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parameter_parse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter_id', 'update_time'], 'integer'],
            [['json_value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parameter_id' => Yii::t('app', 'Parameter ID'),
            'json_value' => Yii::t('app', 'Json Value'),
            'update_time' => Yii::t('app', 'Update Time'),
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
									
			case 'json_value':
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
									
			case 'json_value':
			   return $this->json_value;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
			default:
			break;
		  }
    }
    public function updateTable()
     {
        $p=Parameter::findOne($this->parameter_id);
        if ($p->type==0)//district wise
        {
          //read value from the model and depending on case feed it
          foreach (District::find()->all() as $district)
          {
             $pv=ParameterValue::find()->where(['parameter_id'=>$this->parameter_id,'district_id'=>$district->district_code])->one();
            if (!$pv)
              $pv = new ParameterValue;
             $pv->parameter_id=$this->parameter_id;
             $pv->district_id = $district->district_code;
             switch($p->shortcode)
             {
             case 'mandays':
             $x= Json::decode($this->json_value,true);
             $m=date('Y')-2015+date('m')-3;
             $pv->parameter_value=print_r($x[$district->district_name][$m]['per'],true);
             break;
             default:
             break;
             }
             $pv->update_time=$this->update_time;
             if (!$pv->save())
                print_r( $pv->errors);
          
          }
        
        }
     
     }
	
}
