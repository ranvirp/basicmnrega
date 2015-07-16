<?php

use yii\db\Schema;
use yii\db\Migration;

class m150716_032848_enquiry_reports extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
       
         $this->createTable('{{%enquiryreport_point}}', [
            'id' => Schema::TYPE_PK,
            'complaint_point_id'=>Schema::TYPE_INTEGER,
            'trueorfalse'=>Schema::TYPE_INTEGER,
            'report'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            'amounttoberecovered'=>Schema::TYPE_DOUBLE,
            'amountfrom'=>Schema::TYPE_DOUBLE,
            'firproposed'=>Schema::TYPE_INTEGER,
            'firproposedreason'=>Schema::TYPE_TEXT,
            'daproposed'=>Schema::TYPE_INTEGER,
            'daproposeddetails'=>Schema::TYPE_TEXT,
             'author'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
         ], $tableOptions);
         $this->createTable('{{%atr_point}}', [
            'id' => Schema::TYPE_PK,
            'complaint_point_id'=>Schema::TYPE_INTEGER,
            'atrstatus'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            'amountrecovered'=>Schema::TYPE_DOUBLE,
            'amountfrom'=>Schema::TYPE_DOUBLE,
            'firdone'=>Schema::TYPE_INTEGER,
            'firdetails'=>Schema::TYPE_TEXT,
            'dadone'=>Schema::TYPE_INTEGER,
            'dadetails'=>Schema::TYPE_TEXT,
             'author'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
         ], $tableOptions);
        
       
        $this->createTable('{{%enquiryreport_summary}}', [
            'id' => Schema::TYPE_PK,
            'complaint_id'=>Schema::TYPE_INTEGER,
            'description'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            'complainttrue'=>Schema::TYPE_INTEGER,
            'amountinvolved'=>Schema::TYPE_DOUBLE,
            'firproposed'=>Schema::TYPE_INTEGER,
            'daproposed'=>Schema::TYPE_INTEGER,
             'author'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
             
            ], $tableOptions); 
            $this->createTable('{{%atr_summary}}', [
            'id' => Schema::TYPE_PK,
            'complaint_id'=>Schema::TYPE_INTEGER,
            'description'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            'amountrecovered'=>Schema::TYPE_DOUBLE,
            'firdone'=>Schema::TYPE_INTEGER,
            'dadone'=>Schema::TYPE_INTEGER,
             'author'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
             
            ], $tableOptions); 
        
            
    }

    public function down()
    {
        echo "m150716_032848_enquiry_reports cannot be reverted.\n";

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
