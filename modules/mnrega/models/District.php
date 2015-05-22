<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property string $district_code
 * @property string $district_name
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
            [['district_code'], 'required'],
            [['district_code'], 'string', 'max' => 4],
            [['district_name'], 'string', 'max' => 100]
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
			 
			default:
			break;
		  }
    }
	
}
