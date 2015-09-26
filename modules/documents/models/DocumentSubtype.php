<?php
namespace app\modules\documents\models;

use Yii;

/**
 * This is the model class for table "document_subtype".
 *
 * @property string $shortcode
 * @property string $document_type_code
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 *
 * @property DocumentType $documentTypeCode
 */
class DocumentSubtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_subtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortcode', 'document_type_code', 'name_hi', 'name_en', 'description'], 'required'],
            [['description'], 'string'],
            [['shortcode', 'document_type_code'], 'string', 'max' => 10],
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
            'document_type_code' => 'Document Type Code',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentTypeCode()
    {
        return $this->hasOne(DocumentType::className(), ['shortcode' => 'document_type_code']);
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
									
			case 'document_type_code':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(DocumentType::find()->asArray()->all(),"shortcode","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'hindiinput']);
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
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
		   
									
			case 'shortcode':
			   return $this->shortcode;			    break;
									
			case 'document_type_code':
			   return DocumentType::findOne($this->document_type_code)->$name;			    break;
									
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
