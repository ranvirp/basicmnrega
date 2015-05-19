<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "village".
 *
 * @property string $district_code
 * @property string $block_code
 * @property string $code
 * @property string $name_hi
 * @property string $name_en
 * @property string $census_code
 *
 * @property Work[] $works
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'village';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['district_code', 'block_code', 'name_hi', 'name_en'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 5],
            [['census_code'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'district_code' => 'District Code',
            'block_code' => 'Block Code',
            'code' => 'Code',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'census_code' => 'Census Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['village_code' => 'code']);
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
									
			case 'block_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'census_code':
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
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'code':
			   return $this->code;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'census_code':
			   return $this->census_code;			    break;
			 
			default:
			break;
		  }
    }
	
}
