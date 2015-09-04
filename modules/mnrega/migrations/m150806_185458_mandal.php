<?php

use yii\db\Schema;
use yii\db\Migration;

class m150806_185458_mandal extends Migration
{
    public function safeUp()
    {
      $tableOptions='';
       if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable('{{%mandal}}', [
            'code' => Schema::TYPE_STRING.' PRIMARY KEY',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            ],$tableOptions);
    }

    public function down()
    {
        echo "m150806_185458_mandal cannot be reverted.\n";

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
