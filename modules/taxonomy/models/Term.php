<?php
namespace app\modules\taxonomy\models;

use Yii;

/**
 * This is the model class for table "term".
 *
 * @property string $termcode
 * @property string $vocabcode
 * @property string $termname
 *
 * @property Tagging[] $taggings
 * @property Vocabulary $vocabcode0
 */
class Term extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['termcode', 'vocabcode', 'termname'], 'required'],
            [['termcode', 'vocabcode'], 'string', 'max' => 20],
            [['termname'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'termcode' => 'Termcode',
            'vocabcode' => 'Vocabcode',
            'termname' => 'Termname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaggings()
    {
        return $this->hasMany(Tagging::className(), ['termcode' => 'termcode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVocabcode0()
    {
        return $this->hasOne(Vocabulary::className(), ['vocabcode' => 'vocabcode']);
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'termcode':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'vocabcode':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Vocabulary::find()->asArray()->all(),"vocabcode","vocabname"),["prompt"=>"None.."]);
			    
			    break;
									
			case 'termname':
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
	    $name='vocabname';
		switch ($attribute)
		  {
		   
									
			case 'termcode':
			   return $this->termcode;			    break;
									
			case 'vocabcode':
			   return Vocabulary::findOne($this->vocabcode)->$name;			    break;
									
			case 'termname':
			   return $this->termname;			    break;
			 
			default:
			break;
		  }
    }
	
}
