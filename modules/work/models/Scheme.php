<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "scheme".
 *
 * @property string $code
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 * @property string $finyear
 * @property string $documents
 * @property integer $noofworks
 * @property double $totalcost
 */
class Scheme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scheme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['noofworks'], 'integer'],
            [['totalcost'], 'string'],
            [['code', 'name_hi', 'name_en', 'description', 'finyear', 'documents'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'description' => 'Description',
            'finyear' => 'Finyear',
            'documents' => 'Documents',
            'noofworks' => 'Noofworks',
            'totalcost' => 'Totalcost',
        ];
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'code':
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
									
			case 'finyear':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'documents':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'noofworks':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'totalcost':
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
		   
									
			case 'code':
			   return $this->code;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'finyear':
			   return $this->finyear;			    break;
									
			case 'documents':
			   return $this->documents;			    break;
									
			case 'noofworks':
			   return $this->noofworks;			    break;
									
			case 'totalcost':
			   return $this->totalcost;			    break;
			 
			default:
			break;
		  }
    }
	
}
