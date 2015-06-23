<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $request_type_id
 * @property string $request_subject
 * @property string $content
 * @property string $attachments
 * @property integer $author_id
 * @property integer $create_time
 * @property integer $update_time
 *
 * @property Marking[] $markings
 * @property RequestType $requestType
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_type_id', 'author_id', 'create_time', 'update_time'], 'integer'],
            [['request_subject'], 'required'],
            [['content', 'attachments'], 'string'],
            [['request_subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_type_id' => 'Category/Type of Request',
            'request_subject' => 'Subject',
            'content' => 'Description',
            'attachments' => 'Attachments',
            'author_id' => 'Author',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarkings()
    {
        return $this->hasMany(Marking::className(), ['request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestType()
    {
        return $this->hasOne(RequestType::className(), ['id' => 'request_type_id']);
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
									
			case 'request_type_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(RequestType::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'request_subject':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'content':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'attachments':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'author_id':
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
	    $name='name';
	    //.Yii::$app->language;
		switch ($attribute)
		  {
		   
									
			case 'id':
			   return $this->id;			    break;
									
			case 'request_type_id':
			   return RequestType::findOne($this->request_type_id)->$name;			    break;
									
			case 'request_subject':
			   return $this->request_subject;			    break;
									
			case 'content':
			   return $this->content;			    break;
									
			case 'attachments':
			   return $this->attachments;			    break;
									
			case 'author_id':
			   return $this->author_id;			    break;
									
			case 'create_time':
			   return $this->create_time;			    break;
									
			case 'update_time':
			   return $this->update_time;			    break;
			 
			default:
			break;
		  }
    }
	
}
