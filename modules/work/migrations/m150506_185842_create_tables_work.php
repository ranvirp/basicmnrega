<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_185842_create_tables_work extends Migration
{
    public function safeUp()
    {
             if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable('{{%work}}', [
            'id' => Schema::TYPE_PK,
            'workid'=>Schema::TYPE_STRING.' NOT NULL',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'description'=>Schema::TYPE_TEXT,
            'agency_id'=>Schema::TYPE_INTEGER,
            'work_type_id'=>Schema::TYPE_INTEGER,
            'totvalue'=>Schema::TYPE_DOUBLE,
            'scheme_id'=>Schema::TYPE_INTEGER,
             'district_id'=>Schema::TYPE_INTEGER,
             'address'=>Schema::TYPE_STRING,
             'gpslat'=>Schema::TYPE_DOUBLE,
             'gpslong'=>Schema::TYPE_DOUBLE,
             'work_admin'=>Schema::TYPE_INTEGER,
             'block_id'=>Schema::TYPE_INTEGER,
             'panchayat_id'=>Schema::TYPE_INTEGER.' DEFAULT NULL',
             'village_id'=>Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'remarks'=>Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
         $this->createTable('{{%work_progress}}', [
            'id' => Schema::TYPE_PK,
            'work_id'=>Schema::TYPE_INTEGER,
            'exp'=>Schema::TYPE_DOUBLE,
            'phy'=>Schema::TYPE_INTEGER,
            'fin'=>Schema::TYPE_INTEGER,
            ],$tableOptions);
         $this->createTable('{{%work_type}}', [
            'code' => Schema::TYPE_STRING.'(5)',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            ],$tableOptions);
            //level classes 
            $this->createTable('{{%district}}', [
            'id'=>Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING.'(5)',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'census_code'=>Schema::TYPE_STRING.'(7)',
            
            ],$tableOptions);
            $this->createTable('{{%block}}', [
            'id'=>Schema::TYPE_PK,
            'district_code'=>Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING.'(5)',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'census_code'=>Schema::TYPE_STRING.'(7)',
            
            ],$tableOptions);
            $this->createTable('{{%panchayat}}', [
            'id'=>Schema::TYPE_PK,
            'district_code'=>Schema::TYPE_STRING,
            'block_code'=>Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING.'(5)',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'census_code'=>Schema::TYPE_STRING.'(7)',
            
            ],$tableOptions);
            $this->createTable('{{%village}}', [
            'id'=>Schema::TYPE_PK,
            'district_code'=>Schema::TYPE_STRING,
            'block_code'=>Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING.'(5)',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'census_code'=>Schema::TYPE_STRING.'(7)',
            
            ],$tableOptions);
         
             $this->createTable('{{%scheme}}', [
            'id'=>Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING.'(10)',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'description'=>Schema::TYPE_STRING,
            'finyear'=>Schema::TYPE_STRING,
            'documents'=>Schema::TYPE_STRING,
            'noofworks'=>Schema::TYPE_INTEGER,
            'totalcost'=>Schema::TYPE_DOUBLE,
            
            ],$tableOptions);
                    $authManager=Yii::$app->authManager;
         if ($authManager)
          {
           $workadminrole=$authManager->createRole('workadmin');
           $authManager->add($webadminrole);
           
           $permissions=['edit','delete','create','view','index','update'];
            $tables=['work','work_progress','work_type','scheme',
       'district','block','panchayat','village'];
     foreach($tables as $table)
            {
              foreach($permissions as $permission)
                {
                  if (!($authpermission=$authManager->getPermission($table.$permission)))
                     {
                       $authpermission=$authManager->createPermission($table.$permission);
                       $authpermission->description=$permission.' of controller '.$table;
                       $authManager->add($authpermission);
                     }
                    $authManager->addChild($workadminrole,$authpermission);
                }
            }
      $this->addForeignKey('work_agency_fkey','{{%work}}','agency_id','{{%agency}}','id');
      $this->addForeignKey('work_work_type_fkey','{{%work}}','work_type_ie','{{%work_type}}','id');
      $this->addForeignKey('work_substation_fkey','{{%work}}','substation_id','{{%substation}}','id');
      $this->addForeignKey('work_division_fkey','{{%work}}','division_id','{{%division}}','id');
      $this->addForeignKey('work_fundingdept_fkey','{{%work}}','fundingdept_id','{{%department}}','id');
      $this->addForeignKey('work_feeder_fkey','{{%work}}','feeder_id','{{%feeder}}','id');
      $this->addForeignKey('work_scheme_fkey','{{%work}}','scheme_id','{{%scheme}}','id');
      
      $this->addForeignKey('work_progress_work_fkey','{{%work_progress}}','work_id','{{%work}}','id');
      $this->addForeignKey('substation_division_fkey','{{%substation}}','division_id','{{%division}}','id');
      $this->addForeignKey('feeder_substation_fkey','{{%feeder}}','substation_id','{{%substation}}','id');
      $this->addForeignKey('division_circle_fkey','{{%division}}','circle_id','{{%circle}}','id');
      $this->addForeignKey('aearea_division_fkey','{{%ae_area}}','division_id','{{%division}}','id');
      $this->addForeignKey('jearea_division_fkey','{{%je_area}}','division_id','{{%division}}','id');
      $this->addForeignKey('materialrequirement_work_fkey','{{%material_requirement}}','division_id','{{%division}}','id');
       $this->addForeignKey('materialrequirement_materialtype_fkey','{{%material_requirement}}','material_type_id','{{%material_type}}','id');
     
      
    }

    public function safeDown()
    {
      $this->dropForeignKey('work_agency_fkey','{{%work}}');
      $this->dropForeignKey('work_work_type_fkey','{{%work}}');
      $this->dropForeignKey('work_substation_fkey','{{%work}}');
      $this->dropForeignKey('work_division_fkey','{{%work}}');
      $this->dropForeignKey('work_fundingdept_fkey','{{%work}}');
      $this->dropForeignKey('work_feeder_fkey','{{%work}}');
      $this->dropForeignKey('work_scheme_fkey','{{%work}}');
      
      $this->dropForeignKey('work_progress_work_fkey','{{%work_progress}}');
      $this->dropForeignKey('substation_division_fkey','{{%substation}}');
      $this->dropForeignKey('feeder_substation_fkey','{{%feeder}}');
      $this->dropForeignKey('division_circle_fkey','{{%division}}');
      $this->dropForeignKey('aearea_division_fkey','{{%ae_area}}');
      $this->dropForeignKey('jearea_division_fkey','{{%je_area}}');
      $this->dropForeignKey('materialrequirement_work_fkey','{{%material_requirement}}');
      $this->dropForeignKey('materialrequirement_materialtype_fkey','{{%material_requirement}}');
      $this->dropTable('{{%work}}');
      $this->dropTable('{{%work_progress}}');
      $this->dropTable('{{%work_type}}');
      $this->dropTable('{{%scheme}}');
      $this->dropTable('{{%material_requirement}}');
      $this->dropTable('{{%material_type}}');
      $this->dropTable('{{%je_area}}');
      $this->dropTable('{{%ae_area}}');
      $this->dropTable('{{%division}}');
      $this->dropTable('{{%circle}}');
      $this->dropTable('{{%substation}}');
      $this->dropTable('{{%feeder}}');


    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
