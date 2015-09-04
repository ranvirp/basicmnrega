<?php

use yii\db\Schema;
use yii\db\Migration;

class m150725_173552_complaint_reply extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%complaint_reply}}', [
            'id' => Schema::TYPE_PK,
            'marking_id'=>Schema::TYPE_INTEGER,
            'reply' => Schema::TYPE_TEXT,
            'attachments' => Schema::TYPE_STRING,
            'reply_type'=>Schema::TYPE_INTEGER,
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at'=>Schema::TYPE_INTEGER,
            'author'=>Schema::TYPE_INTEGER,
            
              ], $tableOptions);
     
    }

    public function safeDown()
    {
        echo "m150725_173552_complaint_reply cannot be reverted.\n";

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
