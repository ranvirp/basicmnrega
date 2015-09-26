<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_214608_create_link_table extends Migration
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
            'name_hi' => Schema::TYPE_STRING.'(4000) NOT NULL',
            'name_en' => Schema::TYPE_STRING.'(1000) default NULL',
            'description' => Schema::TYPE_TEXT.' NOT NULL',
            'url'=>Schema::TYPE_STRING.'(5000) NOT NULL',
            'dateofurl'=>Schema::TYPE_DATE,
            'created_by'=>Schema::TYPE_INTEGER,
            'created_at'=>Schema::TYPE_INTEGER,
            'published'=>Schema::TYPE_INTEGER,
            'public'=>Schema::TYPE_INTEGER,
            
            
              ], $tableOptions);
    }

    public function down()
    {
        echo "m150926_214608_create_link_table cannot be reverted.\n";

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
