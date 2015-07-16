<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "complaint_type".
 *
 * @property string $shortcode
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 *
 * @property ComplaintPoint[] $complaintPoints
 * @property ComplaintSubtype[] $complaintSubtypes
 */
class Complaint_type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortcode', 'name_hi', 'name_en', 'description'], 'required'],
            [['description'], 'string'],
            [['shortcode'], 'string', 'max' => 10],
            [['name_hi', 'name_en'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shortcode' => 'Shortcode',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaintPoints()
    {
        return $this->hasMany(ComplaintPoint::className(), ['complaint_type' => 'shortcode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaintSubtypes()
    {
        return $this->hasMany(ComplaintSubtype::className(), ['complaint_type_code' => 'shortcode']);
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'shortcode':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textArea(['class'=>'form-control hindiinput']);
			    
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
		   
									
			case 'shortcode':
			   return $this->shortcode;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
			 
			default:
			break;
		  }
    }
	
}
