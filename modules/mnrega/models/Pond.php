<?php
namespace app\modules\mnrega\models;

use Yii;

/**
 * This is the model class for table "pond".
 *
 * @property string $workid
 * @property string $name_hi
 * @property string $name_en
 * @property string $district_code
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $village
 * @property string $gatasankhya
 * @property string $totarea
 * @property double $estcost
 * @property integer $persondays
 * @property double $gpslat
 * @property double $gpslong
 * @property integer $status
 * @property string $remarks
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Block $blockCode
 * @property District $districtCode
 * @property Panchayat $panchayatCode
 */
class Pond extends \yii\db\ActiveRecord
{
   public static function statuses()
   {
     return ['0'=>'Not Started','1'=>'Ongoing','2'=>'Completed'];
   
   }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pond';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workid','name_hi','estcost','persondays','block_code','panchayat_code','totarea','status'], 'required'],
            [['estcost', 'gpslat', 'gpslong', 'remarks','district','panchayat','block'], 'string'],
            [['persondays', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['workid', 'name_hi', 'name_en', 'district_code', 'block_code', 'panchayat_code', 'village', 'gatasankhya', 'totarea'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workid' => 'Workid',
            'name_hi' => 'Name in Hindi',
            'name_en' => 'Name in English',
            'district_code' => 'District Code',
            'block_code' => 'Block',
            'panchayat_code' => 'Panchayat',
            'village' => 'Village',
            'gatasankhya' => 'गाटा संख्या',
            'totarea' => 'Area',
            'estcost' => 'Estimated Cost',
            'persondays' => 'Expected Person Days',
            'gpslat' => 'Gpslat',
            'gpslong' => 'Gpslong',
            'status' => 'Status',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockCode()
    {
        return $this->hasOne(Block::className(), ['code' => 'block_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrictCode()
    {
        return $this->hasOne(District::className(), ['code' => 'district_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPanchayatCode()
    {
        return $this->hasOne(Panchayat::className(), ['code' => 'panchayat_code']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoCount()
    {
        return $this->hasMany(\app\modules\gpsphoto\models\Photo::className(), ['bwid' => 'workid'])->count();
    }
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
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
		switch ($attribute)
		  {
		   
									
			case 'workid':
			   return  $form->field($this,$attribute)->textInput(['id'=>'workid','class'=>'form-control required']);
			 //  ->widget(\yii\widgets\MaskedInput::className(), [
      //'mask' => '9999999999/WC/999999999999999999',
      //'options'=>['id'=>'workid','class'=>'form-control required'],
  //]);
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control hindiinput']);
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_code':
			 $url="'"."/basicmnrega/web/jsons/'+$(this).val()+'.json'";
			   $id='block-code';
			if ($district!=null)
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>$district])->label(false);
			   else
			     return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->orderBy('name_en asc')->all(),"code","name_".Yii::$app->language),["prompt"=>"None..",
			   'onChange'=>'$(\'#district-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control']);
			 
			    
			    
			    break;
			    case 'district':
			    if ($district!=null)
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>$district_name,'id'=>'district-name'])->label(false);
			    else 
			       return  $form->field($this,$attribute)->hiddenInput(['id'=>'district-name'])->label(false);
			
			    break;
			    case 'block':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>'','id'=>'block-name'])->label(false);
			    
			    break;
			    case 'panchayat':
			   return  $form->field($this,$attribute)->hiddenInput(['value'=>'','id'=>'panchayat-name'])->label(false);
			    
			    break;
									
			case 'block_code':
			   $url="'"."/basicmnrega/web/jsons/'+$(this).val()+'.json'";
			   $id='pond-panchayat';
			   if ($district!=null)
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->where(['district_code'=>$district])->orderBy('name_en asc')->all(),"code","name_en"),["prompt"=>"None..",
			   'onChange'=>'$(\'#block-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control']);
			   else
			     return  $form->field($this,$attribute)->dropDownList([],["prompt"=>"None..",
			   'onChange'=>'$(\'#block-name\').val($(\'option:selected\',this).text());populateDropdown('.$url.",'".$id."')",'class'=>'form-control','id'=>'block-code']);
			 
			    
			    break;
									
			case 'panchayat_code':
			   return  
			   $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Panchayat::find()->asArray()->where(['block_code'=>$this->block_code])->all(),"code","name_en"),["prompt"=>"None..",'id'=>'pond-panchayat',
			   'onChange'=>"$('#panchayat-name').val($('option:selected',this).text());$('#workid').val($(this).val()+'/')",'class'=>'form-control']);
			    
			    break;
									
			case 'village':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gatasankhya':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'totarea':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control']);
			    
			    break;
									
			case 'estcost':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control']);
			    
			    break;
									
			case 'persondays':
			   return  $form->field($this,$attribute)->textInput(['class'=>'form-control']);
			    
			    break;
									
			case 'gpslat':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gpslong':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'status':
			      return  $form->field($this,$attribute)->dropDownList(self::statuses());
			 
			    break;
									
			case 'remarks':
			    return  $form->field($this,$attribute)->textInput();
			   
			    break;
									
			case 'created_at':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'updated_at':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'created_by':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'updated_by':
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
		   
									
			case 'workid':
			   return $this->workid;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'district_code':
			   return District::findOne($this->district_code)->$name;			    break;
									
			case 'block_code':
			   return Block::findOne($this->block_code)->$name;			    break;
									
			case 'panchayat_code':
			   return Panchayat::findOne($this->panchayat_code)->$name;			    break;
									
			case 'village':
			   return $this->village;			    break;
									
			case 'gatasankhya':
			   return $this->gatasankhya;			    break;
									
			case 'totarea':
			   return $this->totarea;			    break;
									
			case 'estcost':
			   return $this->estcost;			    break;
									
			case 'persondays':
			   return $this->persondays;			    break;
									
			case 'gpslat':
			   return $this->gpslat;			    break;
									
			case 'gpslong':
			   return $this->gpslong;			    break;
									
			case 'status':
			   return self::statuses()[$this->status];			    break;
									
			case 'remarks':
			   return $this->remarks;			    break;
									
			case 'created_at':
			   return $this->created_at;			    break;
									
			case 'updated_at':
			   return $this->updated_at;			    break;
									
			case 'created_by':
			   return $this->created_by;			    break;
									
			case 'updated_by':
			   return $this->updated_by;			    break;
			 
			default:
			break;
		  }
    }
    /**
     * @inheritdoc
     */
    public function stickyAttributes()
    {
        return array_merge(parent::stickyAttributes(), ['block_code', 'panchayat_code']);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'estcost' => 'Estimated Cost in Rs. Lakhs',
            'persondays' => 'Estimated Person Days',
            'totarea' => 'Area in Ha.',
            'workid'=>'Work ID as entered in MNREGA',
            'name_hi'=>'Type Name in English, it shall be automatically converted to Hindi',
          
        ]);
    }

	public function getPhotos()
	{
	        return $this->hasMany(\app\modules\gpsphoto\models\Photo::className(), ['bwid' => 'workid'])	;
	}

	public static function getSummaryCount()
	{
	  $sql ="select district,count(*) as count from pond group by district order by district";
	  $command=Yii::$app->db->createCommand($sql);
	  return $command->queryAll();
	  
	
	}
}

