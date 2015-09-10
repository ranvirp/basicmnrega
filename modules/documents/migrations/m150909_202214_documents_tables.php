<?php

use yii\db\Schema;
use yii\db\Migration;

class m150909_202214_documents_tables extends Migration
{
    public function safeUp()
    {
       $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%link}}', [
            'id' => Schema::TYPE_PK,
            'name_hi'=>Schema::TYPE_STRING.'(1000) NOT NULL',
             'name_en'=>Schema::TYPE_STRING.'(1000) NOT NULL',
           
            'url'=>Schema::TYPE_TEXT,
            'size'=>Schema::TYPE_INTEGER,
            'type'=>Schema::TYPE_STRING,
            'mime'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            
              ], $tableOptions);
         $this->createTable('{{%photo}}', [
            'id' => Schema::TYPE_PK,
            'articleid'=>Schema::TYPE_INTEGER,
            'uniqid'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            'title'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            'filename'=>Schema::TYPE_TEXT,
            'url'=>Schema::TYPE_TEXT,
            'path'=>Schema::TYPE_TEXT,
            'size'=>Schema::TYPE_INTEGER,
            'mime'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            'thumbnailpath'=>Schema::TYPE_TEXT,
            'thumbnailurl'=>Schema::TYPE_TEXT,
            'height'=>Schema::TYPE_INTEGER,
            'width'=>Schema::TYPE_INTEGER,
            'uploaded_at'=>Schema::TYPE_INTEGER,
            'uploaded_by'=>Schema::TYPE_INTEGER,
            'public_access'=>Schema::TYPE_INTEGER.' default 1'
            
              ], $tableOptions);
         $this->createTable('{{%document}}', [
            'id' => Schema::TYPE_PK,
            'articleid'=>Schema::TYPE_INTEGER,
            'uniqid'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            'title'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            'filename'=>Schema::TYPE_TEXT,
            'url'=>Schema::TYPE_TEXT,
            'path'=>Schema::TYPE_TEXT,
            'size'=>Schema::TYPE_INTEGER,
            'mime'=>Schema::TYPE_STRING.'(1000) NOT NULL',
            'uploaded_at'=>Schema::TYPE_INTEGER,
            'uploaded_by'=>Schema::TYPE_INTEGER,
            'public_access'=>Schema::TYPE_INTEGER.' default 1'
            
              ], $tableOptions);
    }

    public function down()
    {
        echo "m150909_202214_documents_tables cannot be reverted.\n";

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
