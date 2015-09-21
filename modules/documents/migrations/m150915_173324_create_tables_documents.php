<?php

use yii\db\Schema;
use yii\db\Migration;

class m150915_173324_create_tables_documents extends Migration
{
    public function safeUp()
    {
         $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%document_type}}', [
            'shortcode' => Schema::TYPE_STRING.'(10) NOT NULL PRIMARY KEY',
            'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'name_en' => Schema::TYPE_STRING.'(255) NOT NULL',
            'description' => Schema::TYPE_TEXT.'(255) NOT NULL',
            
            
              ], $tableOptions);
         $this->createTable('{{%document_subtype}}', [
            'shortcode'=>Schema::TYPE_STRING.'(10) NOT NULL PRIMARY KEY',
            'document_type_code' => Schema::TYPE_STRING.'(10) NOT NULL',
            'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'name_en' => Schema::TYPE_STRING.'(255) NOT NULL',
            'description' => Schema::TYPE_TEXT.'(255) NOT NULL',
            
            
              ], $tableOptions);
        $this->addForeignKey('document_type_fkey','{{%document_subtype}}','document_type_code','{{%document_type}}','shortcode');
        $this->createTable('{{%document}}', [
            'id' => Schema::TYPE_PK,
             'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            'document_type' => Schema::TYPE_STRING.'(10) NOT NULL',
            'document_subtype' => Schema::TYPE_STRING.'(10) NOT NULL',
            'description'=>Schema::TYPE_TEXT,
            'shorttext'=>Schema::TYPE_TEXT,
            'fulltext'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            'gallery'=>Schema::TYPE_TEXT,
            'author'=>Schema::TYPE_INTEGER,
            'status'=>Schema::TYPE_INTEGER.' default 0',
             
            'create_time'=>Schema::TYPE_INTEGER,
            'update_time'=>Schema::TYPE_INTEGER,
            
              ], $tableOptions);  
    }

    public function down()
    {
        echo "m150915_173324_create_tables_documents cannot be reverted.\n";

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
