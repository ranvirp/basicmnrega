<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "block".
 *
 * @property string $block_code
 * @property string $block_name
 * @property string $district_code
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
            [['block_code'], 'required'],
            [['block_code'], 'string', 'max' => 7],
            [['block_name'], 'string', 'max' => 100],
            [['district_code'], 'string', 'max' => 4]
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
			 
			default:
			break;
		  }
    }
	
}
