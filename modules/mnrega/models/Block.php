<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property string $block_code
 * @property string $block_name
 * @property string $district_code
 * @property string $name_hi
 * @property string $name_en
 * @property string $code
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_code', 'code'], 'required'],
            [['block_code'], 'string', 'max' => 7],
            [['block_name'], 'string', 'max' => 100],
            [['district_code'], 'string', 'max' => 4],
            [['name_hi', 'name_en', 'code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block_code' => 'Block Code',
            'block_name' => 'Block Name',
            'district_code' => 'District Code',
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
		   
									
			case 'block_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'block_name':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_code':
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
		   
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'block_name':
			   return $this->block_name;			    break;
									
			case 'district_code':
			   return $this->district_code;			    break;
									
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
