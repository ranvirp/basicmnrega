<?php
namespace app\modules\documents\models;

use Yii;

/**
 * This is the model class for table "link".
 *
 * @property integer $id
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 * @property string $url
 * @property string $dateofurl
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $published
 * @property integer $public
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_hi', 'description', 'url'], 'required'],
            [['description'], 'string'],
            [['dateofurl'], 'safe'],
            [['created_by', 'created_at', 'published', 'public'], 'integer'],
            [['name_hi'], 'string', 'max' => 4000],
            [['name_en'], 'string', 'max' => 1000],
            [['url'], 'string', 'max' => 5000]
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
            'name_en' => 'Name En',
            'description' => 'Description',
            'url' => 'Url',
            'dateofurl' => 'Dateofurl',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'published' => 'Published',
            'public' => 'Public',
        ];
    }
    /**
     * @inheritdoc
     */
    public  function behaviors()
    {
        return 
        [
          
             [
                'class' => \app\modules\taxonomy\behaviors\TaggingBehavior::className(),
                'term_prefix' => 'links',
          ],
        
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
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'url':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'dateofurl':
			   return  
			             $form->field($this, "dateofurl")->widget(\yii\jui\DatePicker::classname(), [
'language'=>'en','dateFormat'=>'php:m/d/Y','options' => ['language'=>'en-GB','placeholder' => 'Enter'. $this->attributeLabels()["dateofurl"]." ..."],

]); 			    
			    break;
									
			case 'created_by':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'created_at':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'published':
			   return  $form->field($this,$attribute)->dropDownList([0=>'No',1=>'Yes']);
			    
			    break;
									
			case 'public':
			   return  $form->field($this,$attribute)->dropDownList([0=>'No',1=>'Yes']);
			    
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
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'url':
			   return $this->url;			    break;
									
			case 'dateofurl':
			   return $this->dateofurl;			    break;
									
			case 'created_by':
			   return $this->created_by;			    break;
									
			case 'created_at':
			   return $this->created_at;			    break;
									
			case 'published':
			   return $this->published;			    break;
									
			case 'public':
			   return $this->public;			    break;
			 
			default:
			break;
		  }
    }
     public function printTitle()
    {
        return $this->name_hi;
    }
	
}
