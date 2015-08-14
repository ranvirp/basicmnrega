<?php
namespace app\modules\work\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $uniqueid
 * @property string $workid
 * @property string $name_hi
 * @property string $name_en
 * @property string $description
 * @property string $agency_code
 * @property string $work_type_code
 * @property double $estcost
 * @property string $scheme_code
 * @property string $district_code
 * @property string $block_code
 * @property string $panchayat_code
 * @property string $village_code
 * @property string $district
 * @property string $block
 * @property string $panchayat
 * @property string $village
 * @property string $division_code
 * @property string $address
 * @property double $gpslat
 * @property double $gpslong
 * @property integer $work_admin
 * @property integer $status
 * @property string $remarks
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
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
            [['workid', 'created_at', 'updated_at', 'created_by'], 'required'],
            [['description', 'estcost', 'gpslat', 'gpslong', 'remarks'], 'string'],
            [['work_admin', 'status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['uniqueid', 'workid', 'name_hi', 'name_en', 'agency_code', 'work_type_code', 'district_code', 'block_code', 'panchayat_code', 'village_code', 'district', 'block', 'panchayat', 'village', 'division_code', 'address'], 'string', 'max' => 255],
            [['scheme_code'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniqueid' => 'Uniqueid',
            'workid' => 'Workid',
            'name_hi' => 'Name Hi',
            'name_en' => 'Name En',
            'description' => 'Description',
            'agency_code' => 'Agency Code',
            'work_type_code' => 'Work Type Code',
            'estcost' => 'Estcost',
            'scheme_code' => 'Scheme Code',
            'district_code' => 'District Code',
            'block_code' => 'Block Code',
            'panchayat_code' => 'Panchayat Code',
            'village_code' => 'Village Code',
            'district' => 'District',
            'block' => 'Block',
            'panchayat' => 'Panchayat',
            'village' => 'Village',
            'division_code' => 'Division Code',
            'address' => 'Address',
            'gpslat' => 'Gpslat',
            'gpslong' => 'Gpslong',
            'work_admin' => 'Work Admin',
            'status' => 'Status',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
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
									
			case 'uniqueid':
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
									
			case 'agency_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'work_type_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'estcost':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'scheme_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'block_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'panchayat_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'village_code':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'district':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'block':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'panchayat':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'village':
			   return  $form->field($this,$attribute)->textInput();
			    
			    break;
									
			case 'division_code':
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
									
			case 'uniqueid':
			   return $this->uniqueid;			    break;
									
			case 'workid':
			   return $this->workid;			    break;
									
			case 'name_hi':
			   return $this->name_hi;			    break;
									
			case 'name_en':
			   return $this->name_en;			    break;
									
			case 'description':
			   return $this->description;			    break;
									
			case 'agency_code':
			   return $this->agency_code;			    break;
									
			case 'work_type_code':
			   return $this->work_type_code;			    break;
									
			case 'estcost':
			   return $this->estcost;			    break;
									
			case 'scheme_code':
			   return $this->scheme_code;			    break;
									
			case 'district_code':
			   return $this->district_code;			    break;
									
			case 'block_code':
			   return $this->block_code;			    break;
									
			case 'panchayat_code':
			   return $this->panchayat_code;			    break;
									
			case 'village_code':
			   return $this->village_code;			    break;
									
			case 'district':
			   return $this->district;			    break;
									
			case 'block':
			   return $this->block;			    break;
									
			case 'panchayat':
			   return $this->panchayat;			    break;
									
			case 'village':
			   return $this->village;			    break;
									
			case 'division_code':
			   return $this->division_code;			    break;
									
			case 'address':
			   return $this->address;			    break;
									
			case 'gpslat':
			   return $this->gpslat;			    break;
									
			case 'gpslong':
			   return $this->gpslong;			    break;
									
			case 'work_admin':
			   return $this->work_admin;			    break;
									
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
			 
			default:
			break;
		  }
    }
	
}
