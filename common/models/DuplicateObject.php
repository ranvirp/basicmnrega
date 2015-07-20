<?php
namespace app\common\models;

use Yii;

/**
 * This is the model class for table "duplicate_object".
 *
 * @property integer $id
 * @property string $objecttype
 * @property integer $originalid
 * @property integer $duplicateid
 */
class DuplicateObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'duplicate_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['originalid', 'duplicateid'], 'integer'],
            [['objecttype'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'objecttype' => Yii::t('app', 'Objecttype'),
            'originalid' => Yii::t('app', 'Originalid'),
            'duplicateid' => Yii::t('app', 'Duplicateid'),
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
									
			case 'objecttype':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'originalid':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'duplicateid':
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
									
			case 'objecttype':
			   return $this->objecttype;			    break;
									
			case 'originalid':
			   return $this->originalid;			    break;
									
			case 'duplicateid':
			   return $this->duplicateid;			    break;
			 
			default:
			break;
		  }
    }
	
}
