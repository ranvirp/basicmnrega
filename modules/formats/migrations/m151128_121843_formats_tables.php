<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_121843_formats_tables extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%format}}', [
            'id' => Schema::TYPE_PK,
            'name'=>Schema::TYPE_STRING,
            'label_hi' => Schema::TYPE_STRING.' NOT NULL',
            'label_en' => Schema::TYPE_STRING.' NOT NULL',
            'keyvalue'=>Schema::TYPE_INTEGER,
            'parameters'=>Schema::TYPE_TEXT,
            'calcparameters'=>Schema::TYPE_TEXT,
            'locked'=>Schema::TYPE_INTEGER,
              ], $tableOptions);
         $this->createTable('{{%format_values}}', [
            'id' => Schema::TYPE_PK,
            'format_id'=>Schema::TYPE_STRING,
            'created_by' => Schema::TYPE_INTEGER.' NOT NULL',
            'finyear' => Schema::TYPE_STRING.' NOT NULL',
            'scheme'=>Schema::TYPE_STRING,
            'district'=>Schema::TYPE_STRING,
            'month'=>Schema::TYPE_INTEGER,
            'enteredvalues'=>Schema::TYPE_TEXT,
            'calcvalues'=>Schema::TYPE_TEXT,
            'locked'=>Schema::TYPE_INTEGER,
              ], $tableOptions);
    }

    public function down()
    {
        echo "m151128_121843_formats_tables cannot be reverted.\n";

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
