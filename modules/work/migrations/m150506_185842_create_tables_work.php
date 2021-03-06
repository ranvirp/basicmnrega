#!/usr/bin/php
<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_185842_create_tables_work extends Migration
{
    public function safeUp()
    {
           $tableOptions=null;
             if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
               $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
       $this->dropTable('{{%work}}');
        $this->dropTable('{{%agency}}');
          $this->dropTable('{{%work_progress}}');
      $this->dropTable('{{%work_type}}');
      $this->dropTable('{{%scheme}}');
          $this->dropTable('{{%work_rating}}');
      
    
         $this->createTable('{{%work}}', [
            'id' => Schema::TYPE_PK,
            'uniqueid'=>Schema::TYPE_STRING,
            'workid'=>Schema::TYPE_STRING.' NOT NULL',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'description'=>Schema::TYPE_TEXT,
            'agency_code'=>Schema::TYPE_STRING,
            'work_type_code'=>Schema::TYPE_STRING,
            'estcost'=>Schema::TYPE_DOUBLE,
            'scheme_code'=>Schema::TYPE_STRING.'(50)',
             'district_code'=>Schema::TYPE_STRING,
             
             'block_code'=>Schema::TYPE_STRING,
             'panchayat_code'=>Schema::TYPE_STRING.' DEFAULT NULL',
             'village_code'=>Schema::TYPE_STRING,
              'district'=>Schema::TYPE_STRING,
             
             'block'=>Schema::TYPE_STRING,
             'panchayat'=>Schema::TYPE_STRING.' DEFAULT NULL',
             'village'=>Schema::TYPE_STRING,
             'division_code'=>Schema::TYPE_STRING,
             'address'=>Schema::TYPE_STRING,
             'gpslat'=>Schema::TYPE_DOUBLE,
             'gpslong'=>Schema::TYPE_DOUBLE,
             'work_admin'=>Schema::TYPE_INTEGER,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'remarks'=>Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->createTable('{{%agency}}',[
        'code'=>Schema::TYPE_STRING.' PRIMARY KEY',
         'name_hi'=>Schema::TYPE_STRING,
         'name_en'=>Schema::TYPE_STRING,
         ],$tableOptions);
         $this->createTable('{{%work_progress}}', [
            'id' => Schema::TYPE_PK,
            'work_id'=>Schema::TYPE_INTEGER,
            'exp'=>Schema::TYPE_DOUBLE,
            'phy'=>Schema::TYPE_INTEGER,
            'fin'=>Schema::TYPE_INTEGER,
            ],$tableOptions);
          $this->createTable('{{%work_rating}}', [
            'id' => Schema::TYPE_PK,
            'work_id'=>Schema::TYPE_INTEGER.' default 0',
            'work_type'=>Schema::TYPE_STRING,
            'workid'=>Schema::TYPE_STRING,
            'photo_id'=>Schema::TYPE_INTEGER,
            'rating'=>Schema::TYPE_INTEGER,
            'rating_by'=>Schema::TYPE_INTEGER,
            'rating_at'=>Schema::TYPE_INTEGER,
            'rating_comment'=>Schema::TYPE_TEXT,
            ],$tableOptions);
         $this->createTable('{{%work_type}}', [
            'code'=>Schema::TYPE_STRING.' PRIMARY KEY',
          
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            ],$tableOptions);
            //level classes 
        
         
             $this->createTable('{{%scheme}}', [
            'code'=>Schema::TYPE_STRING.' PRIMARY KEY',
            
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'description'=>Schema::TYPE_STRING,
            'finyear'=>Schema::TYPE_STRING,
            'documents'=>Schema::TYPE_STRING,
            'noofworks'=>Schema::TYPE_INTEGER,
            'totalcost'=>Schema::TYPE_DOUBLE,
            
            ],$tableOptions);
            
             $this->createTable('{{%pond_attributes}}', [
            'workid'=>Schema::TYPE_STRING.' PRIMARY KEY',
            
            'gatanumber'=>Schema::TYPE_STRING,
            'estpersondays'=>Schema::TYPE_STRING,
            'totalarea'=>Schema::TYPE_DOUBLE,
           
            
            ],$tableOptions);
            /*
                    $authManager=Yii::$app->authManager;
         if ($authManager)
          {
           $workadminrole=$authManager->createRole('workadmin');
           $authManager->add($workadminrole);
           
           $permissions=['edit','delete','create','view','index','update'];
            $tables=['work','work_progress','work_type','scheme'];
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
        }
        
      $this->addForeignKey('work_agency_fkey','{{%work}}','agency_id','{{%agency}}','id');
      $this->addForeignKey('work_work_type_fkey','{{%work}}','work_type_id','{{%work_type}}','id');
      $this->addForeignKey('work_scheme_fkey','{{%work}}','scheme_id','{{%scheme}}','id');
      $this->addForeignKey('work_village_fkey','{{%work}}','village_code','{{%village}}','code');
      $this->addForeignKey('block_district_fkey','{{%block}}','district_code','{{%district}}','code');
      */
     
      
    }

    public function safeDown()
    {
      $this->dropForeignKey('work_agency_fkey','{{%work}}');
      $this->dropForeignKey('work_work_type_fkey','{{%work}}');
     $this->dropForeignKey('work_scheme_fkey','{{%work}}');
      
      $this->dropForeignKey('work_progress_work_fkey','{{%work_progress}}');
      $this->dropTable('{{%work}}');
      $this->dropTable('{{%work_progress}}');
      $this->dropTable('{{%work_type}}');
      $this->dropTable('{{%scheme}}');
     


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
