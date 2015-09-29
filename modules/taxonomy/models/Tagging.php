<?php
namespace app\modules\taxonomy\models;

use Yii;

/**
 * This is the model class for table "tagging".
 *
 * @property string $taggedtype
 * @property string $taggedtypepk
 * @property string $termcode
 *
 * @property Taggable $taggedtype0
 * @property Term $termcode0
 */
class Tagging extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tagging';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taggedtypepk', 'termcode'], 'required'],
            [['taggedtype', 'taggedtypepk', 'termcode'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'taggedtype' => 'Taggedtype',
            'taggedtypepk' => 'Taggedtypepk',
            'termcode' => 'Termcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaggedtype0()
    {
        return $this->hasOne(Taggable::className(), ['shortname' => 'taggedtype']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermcode0()
    {
        return $this->hasOne(Term::className(), ['termcode' => 'termcode']);
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'taggedtype':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Taggable::find()->asArray()->all(),"shortname","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'taggedtypepk':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'termcode':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Term::find()->asArray()->all(),"termcode","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
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
		   
									
			case 'taggedtype':
			   return Taggable::findOne($this->taggedtype)->$name;			    break;
									
			case 'taggedtypepk':
			   return $this->taggedtypepk;			    break;
									
			case 'termcode':
			   return Term::findOne($this->termcode)->$name;			    break;
			 
			default:
			break;
		  }
    }
    public function taggedList($termcode,$type=null)
    {
      
      	$query=Tagging::find()
        //->with('taggedtype0','termcode0')
        ->where(['termcode'=>$termcode]);
      	if ($type)
      	{
      		$query->andWhere(['taggedtype'=>$type]);
      		//$class=Taggable::find()->where(['shortcode'=>$type])->one()->classname;
      		//$query=$class::find()
      	}
      	$dataProvider=new \yii\data\ActiveDataProvider(['query'=>$query]);
      	return $dataProvider;

    }
    public static function terms($terms)
    {
      $x=[];
      if (is_array($terms))
      {
        foreach ($terms as $term)
        {
           $model=Term::findOne($term);
           $x[]=$model->termname;
        }
      }
      else {
        $model=Term::findOne($terms);
           $x[]=$model->termname;
      }
      return implode(",",$x);
    }
	
}
