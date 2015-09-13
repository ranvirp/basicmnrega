<?php
namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "request_type".
 *
 * @property integer $id
 * @property integer $category
 * @property string $name
 *
 * @property Request[] $requests
 */
class RequestType extends \yii\db\ActiveRecord
{
 public static function categories()
 {
   return ['MIS','CAG'];
 
 }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['request_type_id' => 'id']);
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
									
			case 'category':
			   return  $form->field($this,$attribute)->dropDownList(self::categories());
			    
			    break;
									
			case 'name':
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
									
			case 'category':
			   return $this->category;			    break;
									
			case 'name':
			   return $this->name;			    break;
			 
			default:
			break;
		  }
    }
	
}
