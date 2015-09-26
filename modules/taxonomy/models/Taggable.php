<?php
namespace app\modules\taxonomy\models;

use Yii;

/**
 * This is the model class for table "taggable".
 *
 * @property string $shortname
 * @property string $classname
 *
 * @property Tagging[] $taggings
 */
class Taggable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taggable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortname'], 'required'],
            [['shortname'], 'string', 'max' => 20],
            [['classname'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shortname' => 'Shortname',
            'classname' => 'Classname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaggings()
    {
        return $this->hasMany(Tagging::className(), ['taggedtype' => 'shortname']);
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'shortname':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'classname':
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
		   
									
			case 'shortname':
			   return $this->shortname;			    break;
									
			case 'classname':
			   return $this->classname;			    break;
			 
			default:
			break;
		  }
    }
	
}
