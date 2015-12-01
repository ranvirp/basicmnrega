<?php
namespace app\modules\formats\models;

use Yii;
use yii\helpers\Html;
use app\modules\mnrega\models\District;

/**
 * This is the model class for table "format".
 *
 * @property integer $id
 * @property string $name
 * @property string $label_hi
 * @property string $label_en
 * @property string $parameters
 * @property string $calcparameters
 */
class Format extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'format';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label_hi', 'label_en'], 'required'],
            [['parameters', 'calcparameters'], 'string'],
            [['name', 'label_hi', 'label_en'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'label_hi' => 'Label  in Hindi',
            'label_en' => 'Label in English',
            'parameters' => 'Parameters',
            'calcparameters' => 'Calcparameters',
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
									
			case 'name':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'label_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
									
			case 'label_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'parameters':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'calcparameters':
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
									
			case 'name':
			   return $this->name;			    break;
									
			case 'label_hi':
			   return $this->label_hi;			    break;
									
			case 'label_en':
			   return $this->label_en;			    break;
									
			case 'parameters':
			   return $this->parameters;			    break;
									
			case 'calcparameters':
			   return $this->calcparameters;			    break;
			 
			default:
			break;
		  }
    }
    /*
      Function which would be used to render form input given a parameter.
      @parameter format (this)

    */
      public function renderForm()
	{
		//print_r($this);
		//exit;
		$parameters=json_decode($this->parameters,true);
		//print_r($parameters);
		//exit;
		$x='';//render string

        // find district now 
        $x.=Html::hiddenInput('id',$this->id);
        $x.=Html::label('Scheme');
        $x.=Html::dropDownList('scheme','',\yii\helpers\ArrayHelper::map(\app\modules\work\models\Scheme::find()->asArray()->orderBy('name_en asc')->all(),"code","name_en"),["prompt"=>"None..",'class'=>'form form-control']);
        $designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
	   if ($designation->designationType->level->name_en=='District')
	   {
	     $district=$designation->level->code;
	     $district_name=$designation->level->name_en;
	   } else if ($designation->designationType->level->name_en=='Block')
	   {
	     $district=substr($designation->level->code,0,4);
	     $district_name=District::findOne($district)->name_en;
	   }
	   else {$district=null;$district_name=null;}
       
        $url="'"."/basicmnrega/web/jsons/'+$(this).val()+'.json'";
		$id='block-code';
        $x.=Html::label('District');
	   if ($district)
	   	 $x.='<p>'.$district_name.'</p>';
	   else

	   	 $x.=   Html::dropDownList('district','',\yii\helpers\ArrayHelper::map(District::find()->asArray()->orderBy('name_en asc')->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#district-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form form-control']);
			 
		//month

		$finyears=['2014-15'=>'2014-15','2015-16'=>'2015-16','2016-17'=>'2016-17'];
		 $x.=Html::label('Financial Year');
		$x.=Html::dropDownList('finyear','2015-16',$finyears,['class'=>'form form-control']);
		$x.=Html::label('Month');
		$months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
        $x.=Html::dropDownList('month',date('m'),$months,['class'=>'form form-control']);

		foreach ($parameters as $parameter)
		{
		switch ($parameter['type'])
		  {
		   
									
			case 'n':
			   $x.=Html::label($parameter['label_hi']);
			   $x.=  Html::textInput(Format::labeltoname($parameter['label_en']),'',['class'=>'form form-control']);
			    
			    break;
			case 't':
			   $x.=Html::label($parameter['label_hi']);
			   $x.=  Html::textInput(Format::labeltoname($parameter['label_en']),'',['class'=>'form form-control']);
			    
			    break;
									
			case 'd':
			   $x.=Html::label($parameter['label_hi']);
			   $dropdown=self::strtoarray($parameter['dropdown']);
			   $x.=  Html::dropDownList(Format::labeltoname($parameter['label_en']),
			   	       '',$dropdown,['class'=>'form form-control']);
			    
			    break;
									
			
			 
			default:
			break;
		  }
		}
		return $x;
    }
    public static function labeltoname($label)
    {
    	$name=strtolower($label);
    	$name=str_replace(" ", "_", $name);
    	return $name;
    }
    public static function strtoarray($str)
    {
    	$x=split("\n", $str);
    	$y=[];
    	foreach($x as $k)
    		$y[$k]=$k;
    	return $y;

    }
       public function enterValues($postarray)
	{
		//print_r($this);
		//exit;
		$month=$postarray['month'];
		$designation=\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one();
	   if ($designation->designationType->level->name_en=='District')
	   {
	     $district=$designation->level->code;
	     $district_name=$designation->level->name_en;
	   } else if ($designation->designationType->level->name_en=='Block')
	   {
	     $district=substr($designation->level->code,0,4);
	     $district_name=District::findOne($district)->name_en;
	   }
	   else {$district=null;$district_name=null;}
	   if ($district==null) $district=$postarray['district'];
	   $formatvalue=FormatValues::find()->where(['month'=>$month,'district'=>$district,'format_id'=>$postarray['id']])->one();
        if (!$formatvalue)
        $formatvalue=new FormatValues;
        $formatvalue->format_id=$postarray['id'];
        $formatvalue->scheme=$postarray['scheme'];
        $formatvalue->month=$postarray['month'];
        $formatvalue->finyear=$postarray['finyear'];
        $formatvalue->created_by=Yii::$app->user->id;
		$parameters=json_decode($this->parameters,true);

		//print_r($parameters);
		//exit;
		$x=[];//values array

        // find district now 

        
       
        $url="'"."/basicmnrega/web/jsons/'+$(this).val()+'.json'";
		$id='block-code';
        if ($district!=null)
            $formatvalue->district=$district;
        else
        	 $formatvalue->district=$postarray['district'];
	      foreach ($parameters as $parameter)
		{
		switch ($parameter['type'])
		  {
		   
									
			case 'n':
			   if (array_key_exists(Format::labeltoname($parameter['label_en']),$postarray) && is_numeric($postarray[Format::labeltoname($parameter['label_en'])]))
			    $x[Format::labeltoname($parameter['label_en'])]=$postarray[Format::labeltoname($parameter['label_en'])];
			    break;
			case 't':
			  if (array_key_exists(Format::labeltoname($parameter['label_en']),$postarray))
			     $x[Format::labeltoname($parameter['label_en'])]=$postarray[Format::labeltoname($parameter['label_en'])];
			    break;
			  						
			case 'd':
			   if (array_key_exists(Format::labeltoname($parameter['label_en']),$postarray) 
			   	//&& in_array($postarray[Format::labeltoname($parameter['label_en'])],array_keys(self::strtoarray($parameter['dropdown'])))
			   	)
			     $x[Format::labeltoname($parameter['label_en'])]=$postarray[Format::labeltoname($parameter['label_en'])];
			    break;
			 
			 
									
			
			 
			default:
			break;
		  }
		}
		if ($this->keyvalue!=0)
		{
			$y[$postarray[Format::labeltoname($parameters[$this->keyvalue]['label_en'])]]=$x;
			if (is_array(json_decode($formatvalue->enteredvalues,true)))
			$formatvalue->enteredvalues=json_encode(array_merge(json_decode($formatvalue->enteredvalues,true),$y));
		   else
		   	 $formatvalue->enteredvalues=json_encode($y);
		}
       else
		$formatvalue->enteredvalues=json_encode($x);
		if ($formatvalue->save())
		return $formatvalue;
	   else {
	   	return $formatvalue->errors;
	   }
    }
public function renderReport($format_id,$month)
{

}
	
}
