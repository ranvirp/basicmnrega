<?php
namespace app\modules\taxonomy\models;

use Yii;

/**
 * This is the model class for table "vocabulary".
 *
 * @property string $vocabcode
 * @property string $vocabname
 *
 * @property Term[] $terms
 */
class Vocabulary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vocabulary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vocabcode', 'vocabname'], 'required'],
            [['vocabcode'], 'string', 'max' => 20],
            [['vocabname'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vocabcode' => 'Vocabcode',
            'vocabname' => 'Vocabname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms()
    {
        return $this->hasMany(Term::className(), ['vocabcode' => 'vocabcode']);
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'vocabcode':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'vocabname':
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
		   
									
			case 'vocabcode':
			   return $this->vocabcode;			    break;
									
			case 'vocabname':
			   return $this->vocabname;			    break;
			 
			default:
			break;
		  }
    }
	
}
