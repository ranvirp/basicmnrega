<?php

use yii\db\Schema;
use yii\db\Migration;

class m150716_145741_workdemand_report extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
     
       $this->createTable('{{%workdemand_report}}', [
            'id' => Schema::TYPE_PK,
             'work_demand_id' => Schema::TYPE_INTEGER,
             'complainttrue'=>Schema::TYPE_STRING.'(1)',
             'description'=>Schema::TYPE_TEXT,
            'work_id' => Schema::TYPE_STRING.'(255) NOT NULL',
            'workname'=>Schema::TYPE_STRING.'(255)',
            'datefrom' => Schema::TYPE_DATE,
            'author'=>Schema::TYPE_INTEGER,
            'create_time'=>Schema::TYPE_INTEGER,
            'update_time'=>Schema::TYPE_INTEGER,
            
            ], $tableOptions); 
        $this->createTable('{{%jobcarddemand_report}}', [
            'id' => Schema::TYPE_PK,
             'jobcarddemand_id' => Schema::TYPE_INTEGER,
              'complainttrue'=>Schema::TYPE_STRING.'(1)',
             'description'=>Schema::TYPE_TEXT,
            
            'jobcardno' => Schema::TYPE_STRING.'(255) NOT NULL',
            'datefrom' => Schema::TYPE_DATE,
            'author'=>Schema::TYPE_INTEGER,
            'create_time'=>Schema::TYPE_INTEGER,
            'update_time'=>Schema::TYPE_INTEGER,
            
            ], $tableOptions); 
    }

    public function down()
    {
        echo "m150716_145741_workdemand_report cannot be reverted.\n";

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
