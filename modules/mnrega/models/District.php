<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $district_code
 * @property string $district_name
 * @property string $name_hi
 * @property string $name_en
 * @property string $code
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code', 'code'], 'required'],
            [['district_code'], 'string', 'max' => 4],
            [['district_name'], 'string', 'max' => 100],
            [['name_hi', 'name_en', 'code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'district_code' => 'District Code',
            'district_name' => 'District Name',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'code' => 'Code',
        ];
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'district_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_name':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'code':
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
		   
									
			case 'district_code':
			   return $this->district_code;			    break;
									
			case 'district_name':
			   return $this->district_name;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'code':
			   return $this->code;			    break;
			 
			default:
			break;
		  }
    }
	
}
