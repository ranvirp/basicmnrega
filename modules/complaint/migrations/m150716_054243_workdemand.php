<?php

use yii\db\Schema;
use yii\db\Migration;

class m150716_054243_workdemand extends Migration
{
    public function safeUp()
    {
     $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
     
$this->createTable('{{%workdemand}}', [
            'id' => Schema::TYPE_PK,
             'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'fname' => Schema::TYPE_STRING.'(255) NOT NULL',
            'gender'=>Schema::TYPE_STRING.'(1)',
            'mobileno' => Schema::TYPE_STRING.'(10) NOT NULL',
            'address'=>Schema::TYPE_TEXT,
            'jobcardno'=>Schema::TYPE_STRING.'(15)',
            'district_code'=>Schema::TYPE_STRING.'(4) NOT NULL',
            'block_code'=>Schema::TYPE_STRING.'(7) NOT NULL',
            'panchayat_code'=>Schema::TYPE_STRING.'(12) NOT NULL',
            'panchayat'=>Schema::TYPE_STRING.'(100) NOT NULL',
            'village'=>Schema::TYPE_STRING,
           'noofdays'=>Schema::TYPE_INTEGER,
            'datefrom'=>Schema::TYPE_DATE,
            'dateto'=>Schema::TYPE_DATE,
            'workchoice'=>Schema::TYPE_TEXT,
            'author'=>Schema::TYPE_INTEGER,
            'create_time'=>Schema::TYPE_INTEGER,
            'update_time'=>Schema::TYPE_INTEGER,
            
              ], $tableOptions); 
$this->createTable('{{%jobcarddemand}}', [
            'id' => Schema::TYPE_PK,
             'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'fname' => Schema::TYPE_STRING.'(255) NOT NULL',
            
            'mobileno' => Schema::TYPE_STRING.'(10) NOT NULL',
            'address'=>Schema::TYPE_TEXT,
             'gender'=>Schema::TYPE_STRING.'(1)',
            'district_code'=>Schema::TYPE_STRING.'(4) NOT NULL',
            'block_code'=>Schema::TYPE_STRING.'(7) NOT NULL',
            'panchayat_code'=>Schema::TYPE_STRING.'(12) NOT NULL',
            'panchayat'=>Schema::TYPE_STRING.'(100) NOT NULL',
            
             'village'=>Schema::TYPE_STRING,
           
            'author'=>Schema::TYPE_INTEGER,
            'create_time'=>Schema::TYPE_INTEGER,
            'update_time'=>Schema::TYPE_INTEGER,
            
              ], $tableOptions); 
    }

    public function down()
    {
        echo "m150716_054243_workdemand cannot be reverted.\n";

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
