<?php

use yii\db\Schema;
use yii\db\Migration;

class m150718_013808_groups extends Migration
{
    public function safeUp()
    {
    //table groupcode,groupname,itemtype,itemcode,itemname 
      $tableOptions=null;
             if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
               $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
         $this->createTable('{{%group}}', [
         'groupcode'=>Schema::TYPE_PK,
         'grouptype'=>Schema::TYPE_STRING,
         'groupname_hi'=>Schema::TYPE_STRING,
         'groupname_en'=>Schema::TYPE_STRING,
         'itemtype'=>Schema::TYPE_STRING,
         'itemcode'=>Schema::TYPE_STRING,
         'itemname_hi'=>Schema::TYPE_STRING,
         'itemname_en'=>Schema::TYPE_STRING,
         ],$tableOptions);
    }

    public function down()
    {
        echo "m150718_013808_groups cannot be reverted.\n";

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
