<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $workid
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 * @property integer $agency_id
 * @property integer $work_type_id
 * @property double $totvalue
 * @property integer $scheme_id
 * @property integer $district_id
 * @property string $address
 * @property double $gpslat
 * @property double $gpslong
 * @property integer $work_admin
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $village_code
 * @property integer $status
 * @property string $remarks
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Agency $agency
 * @property WorkType $workType
 * @property Scheme $scheme
 * @property Village $villageCode
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workid', 'created_at', 'updated_at'], 'required'],
            [['description', 'totvalue', 'gpslat', 'gpslong', 'remarks'], 'string'],
            [['agency_id', 'work_type_id', 'scheme_id', 'district_id', 'work_admin', 'status', 'created_at', 'updated_at'], 'integer'],
            [['workid', 'name_hi', 'name_en', 'address', 'block_code', 'panchayat_code', 'village_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workid' => 'Workid',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'description' => 'Description',
            'agency_id' => 'Agency ID',
            'work_type_id' => 'Work Type ID',
            'totvalue' => 'Totvalue',
            'scheme_id' => 'Scheme ID',
            'district_id' => 'District ID',
            'address' => 'Address',
            'gpslat' => 'Gpslat',
            'gpslong' => 'Gpslong',
            'work_admin' => 'Work Admin',
            'block_code' => 'Block Code',
            'panchayat_code' => 'Panchayat Code',
            'village_code' => 'Village Code',
            'status' => 'Status',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasOne(Agency::className(), ['id' => 'agency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkType::className(), ['id' => 'work_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheme()
    {
        return $this->hasOne(Scheme::className(), ['id' => 'scheme_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillageCode()
    {
        return $this->hasOne(Village::className(), ['code' => 'village_code']);
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
									
			case 'workid':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_hi':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'name_en':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'description':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'agency_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Agency::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'work_type_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(WorkType::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'totvalue':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'scheme_id':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Scheme::find()->asArray()->all(),"id","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
			    break;
									
			case 'district_id':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'address':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gpslat':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'gpslong':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'work_admin':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'block_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'panchayat_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'village_code':
			   return  $form->field($this,$attribute)->dropDownList(\yii\helpers\ArrayHelper::map(Village::find()->asArray()->all(),"code","name_".Yii::$app->language),["prompt"=>"None.."]);
			    
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
									
			case 'workid':
			   return $this->workid;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'agency_id':
			   return Agency::findOne($this->agency_id)->$name;			    break;
									
			case 'work_type_id':
			   return WorkType::findOne($this->work_type_id)->$name;			    break;
									
			case 'totvalue':
			   return $this->totvalue;			    break;
									
			case 'scheme_id':
			   return Scheme::findOne($this->scheme_id)->$name;			    break;
									
			case 'district_id':
			   return $this->district_id;			    break;
									
			case 'address':
			   return $this->address;			    break;
									
			case 'gpslat':
			   return $this->gpslat;			    break;
									
			case 'gpslong':
			   return $this->gpslong;			    break;
									
			case 'work_admin':
			   return $this->work_admin;			    break;
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'panchayat_code':
			   return $this->panchayat_code;			    break;
									
			case 'village_code':
			   return Village::findOne($this->village_code)->$name;			    break;
									
			case 'status':
			   return $this->status;			    break;
									
			case 'remarks':
			   return $this->remarks;			    break;
									
			case 'created_at':
			   return $this->created_at;			    break;
									
			case 'updated_at':
			   return $this->updated_at;			    break;
			 
			default:
			break;
		  }
    }
	
}
