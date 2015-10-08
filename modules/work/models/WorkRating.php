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
   const UNSATISFACTORY=1;
   const SATISFACTORY=2;
   const GOOD=3;
   const VERY_GOOD=4;
   const EXCELLENT=5;
   
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
            [['work_id', 'rating', 'rating_by', 'rating_at','photo_id'], 'integer'],
            [['rating_comment','workid','work_type'], 'string'],
            
        ];
    }
    public static function ratingOptions()
    {
    
    return [
    null=>Yii::t('app','Unrated'),
    self::UNSATISFACTORY=>Yii::t('app','Unsatisfactory'),
    self::SATISFACTORY=>Yii::t('app','Satisfactory'),
    self::GOOD=>Yii::t('app','Good'),
    self::VERY_GOOD=>Yii::t('app','Very Good'),
    self::EXCELLENT=>Yii::t('app','Excellent'),
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
     public function addRating($wtype,$wid,$rating,$photoid,$comment='')
    {
      if (Yii::$app->user->can('complaintadmin'))
      {
        $model=self::find()->where(['work_type'=>$wtype,'workid'=>$wid])->one();
        if (!$model)
         $model=new WorkRating;
         $model->work_type=$wtype;
         $model->workid=$wid;
          $model->photo_id=$photoid;
         $model->rating=$rating;
         $model->rating_comment=$comment;
         $model->rating_by=Yii::$app->user->id;
         $model->rating_at=time();
         if ($model->save())
         return $model->rating;
      
      }
      return -1;
    
    }
	
}
