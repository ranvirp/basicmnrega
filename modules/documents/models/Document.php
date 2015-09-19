<?php
namespace app\modules\documents\models;

use Yii;
use \yii\helpers\Url;
use \yii\helpers\ArrayHelper;


/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property string $name_hi
 * @property string $document_type
 * @property string $document_subtype
 * @property string $description
 * @property string $shorttext
 * @property string $fulltext
 * @property string $attachments
 * @property string $gallery
 * @property integer $author
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 */
class Document extends \yii\db\ActiveRecord
{
  const PUBLISHED=1;
  const NOT_PUBLISHED=0;
   public static function status()
   {
     return 
     [
      self::PUBLISHED=>'Published',
      self::NOT_PUBLISHED=>'Not Published',
     ];
   
   }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_hi', 'document_type', 'document_subtype'], 'required'],
            [['description', 'shorttext', 'fulltext', 'attachments', 'gallery'], 'string'],
            [['author', 'status', 'create_time', 'update_time'], 'integer'],
            [['name_hi'], 'string', 'max' => 255],
            [['document_type', 'document_subtype'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_hi' => 'Name Hi',
            'document_type' => 'Document Type',
            'document_subtype' => 'Document Subtype',
            'description' => 'Description',
            'shorttext' => 'Shorttext',
            'fulltext' => 'Fulltext',
            'attachments' => 'Attachments',
            'gallery' => 'Gallery',
            'author' => 'Author',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
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
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'hindiinput']);
			    
			    break;
									
			case 'document_type':
			       $url=Url::to(['/documents/document-subtype/get?code=']);
  
			       return $form->field($this, $attribute)->dropDownList(ArrayHelper::Map(DocumentType::find()->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None','onChange' => 'populateDropdown("'.$url.'"+$(this).val(),"document_subtype")']);
        	    
			    break;
									
			case 'document_subtype':
			   return $form->field($this, $attribute)->dropDownList(ArrayHelper::Map(DocumentSubtype::find()->where(['document_type_code'=>$this->document_type])->asArray()->all(),'shortcode','name_hi'),['prompt'=>'None','id'=>"document_subtype"]);
        
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textArea(['class'=>'hindiinput']);
			    
			    break;
									
			case 'shorttext':
			   return  $form->field($this,$attribute)->textArea(['class'=>'hindiinput']);
			    
			    break;
									
			case 'fulltext':
			  // return  $form->field($this,$attribute)->textArea(['class'=>'hindiinput']);
			    return  $form->field($this,$attribute)->widget(\yii\imperavi\Widget::classname(),['options'=>['lang'=> 'en']]);
			    break;
									
			case 'attachments':
				   return  $form->field($this,$attribute)->widget(\app\modules\reply\widgets\FileWidget::classname());
		
			    
			    break;
									
			case 'gallery':
			     return  $form->field($this,$attribute)->widget(\app\modules\reply\widgets\FileWidget::classname());
		  
			    break;
									
			case 'author':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'status':
			   return  $form->field($this,$attribute)->dropDownList(self::status());
			    
			    break;
									
			case 'create_time':
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
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'document_type':
			   return $this->document_type;			    break;
									
			case 'document_subtype':
			   return $this->document_subtype;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'shorttext':
			   return $this->shorttext;			    break;
									
			case 'fulltext':
			   return $this->fulltext;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'gallery':
			   return $this->gallery;			    break;
									
			case 'author':
			   return $this->author;			    break;
									
			case 'status':
			   return $this->status;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
			default:
			break;
		  }
    }
	
}
