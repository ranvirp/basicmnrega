<?php
namespace app\modules\documents\models;

use Yii;

/**
 * This is the model class for table "document_type".
 *
 * @property string $shortcode
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 *
 * @property DocumentSubtype[] $documentSubtypes
 */
class DocumentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_type';
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
    public function getDocumentSubtypes()
    {
        return $this->hasMany(DocumentSubtype::className(), ['document_type_code' => 'shortcode']);
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
			   return  $form->field($this,$attribute)->textInput();
			    
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
