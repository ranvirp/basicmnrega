<?php

use yii\db\Schema;
use yii\db\Migration;

class m150713_100030_complainant_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        /*
         $this->createTable('{{%complainant}}', [
            'id' => Schema::TYPE_PK,
            'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'fname' => Schema::TYPE_STRING.'(255) NOT NULL',
            'mobileno' => Schema::TYPE_STRING.'(10) NOT NULL',
            'district_code'=>Schema::TYPE_STRING.'(4) NOT NULL',
            'address'=>Schema::TYPE_TEXT,
            'jobcardno'=>Schema::TYPE_STRING.'(15)',
              ], $tableOptions);
     */
        $this->createTable('{{%complaint}}', [
            'id' => Schema::TYPE_PK,
             'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'fname' => Schema::TYPE_STRING.'(255) NOT NULL',
            'mobileno' => Schema::TYPE_STRING.'(10) NOT NULL',
            'address'=>Schema::TYPE_TEXT,
            'jobcardno'=>Schema::TYPE_STRING.'(15)',
             'source'=>Schema::TYPE_STRING.'(15)',
            'complaint_type' => Schema::TYPE_STRING.'(10) NOT NULL',
           'complaint_subtype' => Schema::TYPE_STRING.'(10) NOT NULL',
            'description'=>Schema::TYPE_TEXT,
            'district_code'=>Schema::TYPE_STRING.'(4) NOT NULL',
            'block_code'=>Schema::TYPE_STRING.'(7) NOT NULL',
            'panchayat_code'=>Schema::TYPE_STRING.'(12) NOT NULL',
            'panchayat'=>Schema::TYPE_STRING.'(100) NOT NULL',
            'status'=>Schema::TYPE_INTEGER.' default 0',
            'attachments'=>Schema::TYPE_TEXT,
            'author'=>Schema::TYPE_INTEGER,
            'create_time'=>Schema::TYPE_INTEGER,
            'update_time'=>Schema::TYPE_INTEGER,
            
              ], $tableOptions);  
        $this->createTable('{{%complaint_point}}', [
            'id' => Schema::TYPE_PK,
            'complaint_id'=>Schema::TYPE_INTEGER,
            'complaint_type'=>Schema::TYPE_STRING.'(10) NOT NULL',
            'complaint_subtype'=>Schema::TYPE_STRING.'(10) NOT NULL',
            'description'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            
              ], $tableOptions); 
        
        
        $this->createTable('{{%complaint_marking}}', [
            'id' => Schema::TYPE_PK,
            'complaint_id' => Schema::TYPE_INTEGER,
            'sender'=>Schema::TYPE_INTEGER,
            'receiver'=>Schema::TYPE_INTEGER,
            'dateofmarking'=>Schema::TYPE_DATE,
            'deadline'=>Schema::TYPE_DATE,
            'status'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
             'read_time'=>Schema::TYPE_INTEGER.' NULL',
            
                    ], $tableOptions); 
       
    
            
            
    }

    public function down()
    {
        echo "m150713_100030_complainant_table cannot be reverted.\n";

        return false;
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
