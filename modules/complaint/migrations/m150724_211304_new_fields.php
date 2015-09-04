<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_211304_new_fields extends Migration
{
    public function safeUp()
    {
      $this->addColumn('{{%marking}}','flag',Schema::TYPE_INTEGER);
      $this->addColumn('{{%complaint}}','flowtype',Schema::TYPE_INTEGER.' default 0');
    }

    public function down()
    {
        echo "m150724_211304_new_fields cannot be reverted.\n";

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
