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
            [['workid', 'created_at', 'updated_at'], 'required'],
            [['estcost', 'gpslat', 'gpslong', 'remarks'], 'string'],
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
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'district_code' => 'District Code',
            'block_code' => 'Block Code',
            'panchayat_code' => 'Panchayat Code',
            'village' => 'Village',
            'gatasankhya' => 'Gatasankhya',
            'totarea' => 'Totarea',
            'estcost' => 'Estcost',
            'persondays' => 'Persondays',
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
	/*
	*@return form of individual elements
	*/
	public function showForm($form,$attribute)
	{
		switch ($attribute)
		  {
		   
									
			case 'workid':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_code':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(District::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'block_code':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Block::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'panchayat_code':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Panchayat::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'village':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gatasankhya':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'totarea':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'estcost':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'persondays':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gpslat':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gpslong':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'status':
			   return  $form->field($this,$attribute)->textInput();
			    
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
			   return $this->status;			    break;
									
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
	
}
