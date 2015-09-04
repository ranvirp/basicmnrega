<?php

use yii\db\Schema;
use yii\db\Migration;

class m150714_002321_complaint_categories extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%complaint_type}}', [
            'shortcode' => Schema::TYPE_STRING.'(10) NOT NULL PRIMARY KEY',
            'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'name_en' => Schema::TYPE_STRING.'(255) NOT NULL',
            'description' => Schema::TYPE_TEXT.'(255) NOT NULL',
            
            
              ], $tableOptions);
         $this->createTable('{{%complaint_subtype}}', [
            'shortcode'=>Schema::TYPE_STRING.'(10) NOT NULL PRIMARY KEY',
            'complaint_type_code' => Schema::TYPE_STRING.'(10) NOT NULL',
            'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'name_en' => Schema::TYPE_STRING.'(255) NOT NULL',
            'description' => Schema::TYPE_TEXT.'(255) NOT NULL',
            
            
              ], $tableOptions);
        $this->addForeignKey('complaint_type_fkey','{{%complaint_subtype}}','complaint_type_code','{{%complaint_type}}','shortcode');
        $this->addForeignKey('complaint_complaint_type_fkey','{{%complaint_point}}','complaint_type','{{%complaint_type}}','shortcode');
        $this->addForeignKey('complaint_complaint_subtype_fkey','{{%complaint_point}}','complaint_subtype','{{%complaint_subtype}}','shortcode');
     
    }

    public function down()
    {
        echo "m150714_002321_complaint_categories cannot be reverted.\n";

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
