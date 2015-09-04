<?php

use yii\db\Schema;
use yii\db\Migration;

class m150718_024155_duplicates extends Migration
{
    public function safeUp()
    {
       $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
     
       $this->createTable('{{%duplicate_object}}', [
        'id'=>Schema::TYPE_PK,
        'objecttype'=>Schema::TYPE_STRING,
        'originalid'=>Schema::TYPE_INTEGER,
        'duplicateid'=>Schema::TYPE_INTEGER,
        
       ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%duplicate_object}}');
      
        return true;
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
