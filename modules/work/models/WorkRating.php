<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "work_rating".
 *
 * @property integer $id
 * @property integer $work_id
 * @property integer $rating
 * @property integer $rating_by
 * @property integer $rating_at
 * @property string $rating_comment
 */
class WorkRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id', 'rating', 'rating_by', 'rating_at'], 'integer'],
            [['rating_comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_id' => 'Work ID',
            'rating' => 'Rating',
            'rating_by' => 'Rating By',
            'rating_at' => 'Rating At',
            'rating_comment' => 'Rating Comment',
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
									
			case 'work_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'rating':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'rating_by':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'rating_at':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'rating_comment':
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
									
			case 'work_id':
			   return $this->work_id;			    break;
									
			case 'rating':
			   return $this->rating;			    break;
									
			case 'rating_by':
			   return $this->rating_by;			    break;
									
			case 'rating_at':
			   return $this->rating_at;			    break;
									
			case 'rating_comment':
			   return $this->rating_comment;			    break;
			 
			default:
			break;
		  }
    }
	
}
