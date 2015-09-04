<?php
namespace app\modules\complaint\models;

use Yii;

/**
 * This is the model class for table "complaint_subtype".
 *
 * @property string $shortcode
 * @property string $complaint_type_code
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 *
 * @property ComplaintPoint[] $complaintPoints
 * @property ComplaintType $complaintTypeCode
 */
class Complaint_subtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint_subtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortcode', 'complaint_type_code', 'name_hi', 'name_en', 'description'], 'required'],
            [['description'], 'string'],
            [['shortcode', 'complaint_type_code'], 'string', 'max' => 10],
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
            'complaint_type_code' => 'Complaint Type Code',
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
        return $this->hasMany(ComplaintPoint::className(), ['complaint_subtype' => 'shortcode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplaintTypeCode()
    {
        return $this->hasOne(ComplaintType::className(), ['shortcode' => 'complaint_type_code']);
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
									
			case 'complaint_type_code':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Complaint_type::find()->asArray()->all(),"shortcode","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
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
									
			case 'complaint_type_code':
			   return Complaint_type::findOne($this->complaint_type_code)->$name;			    break;
									
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
