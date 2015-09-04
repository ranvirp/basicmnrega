<?php

use yii\db\Schema;
use yii\db\Migration;

class m150520_022511_create_mnrega_tables extends Migration
{
   
 public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable('{{%request}}', [
            'id' => Schema::TYPE_PK,
            'request_type_id' => Schema::TYPE_INTEGER,
            'request_subject'=>Schema::TYPE_STRING.' NOT NULL',
            'content'=>Schema::TYPE_TEXT,
            'attachments'=>Schema::TYPE_TEXT,
            'author_id'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
            
                    ], $tableOptions);
                    $this->createTable('{{%marking}}', [
            'id' => Schema::TYPE_PK,
            'request_type' => Schema::TYPE_STRING,
            
            'request_id' => Schema::TYPE_INTEGER,
            'sender'=>Schema::TYPE_INTEGER,
            'receiver'=>Schema::TYPE_INTEGER,
            'dateofmarking'=>Schema::TYPE_DATE,
            'deadline'=>Schema::TYPE_DATE,
            'status'=>Schema::TYPE_INTEGER,
             'create_time'=>Schema::TYPE_INTEGER,
             'update_time'=>Schema::TYPE_INTEGER,
             'read_time'=>Schema::TYPE_INTEGER.' NULL',
            
                    ], $tableOptions);
            $this->createTable('{{%request_type}}', [
            'id' => Schema::TYPE_PK,
            'category' => Schema::TYPE_INTEGER,
            'name'=>Schema::TYPE_STRING,
           
            
                    ], $tableOptions);
             $this->addForeignKey('request_marking_fkey','{{%marking}}','request_id','{{%request}}','id');
             $this->addForeignKey('request_request_type','{{%request}}','request_type_id','{{%request_type}}','id');
    }

    public function down()
    {
        echo "m150520_022511_create_mnrega_tables cannot be reverted.\n";

        return false;
    }
    
    
   

    public function safeDown()
    {
      $this->dropTable('{{%request}}');
      $this->dropTable('{{%request_type}}');
      $this->dropTable('{{%marking}}');
    }
    
}
