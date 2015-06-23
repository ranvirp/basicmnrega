<?php

use yii\db\Schema;
use yii\db\Migration;

class m150614_182719_alter_table_file extends Migration
{
    public function up()
    {
      $this->alterColumn('{{%file}}','mime',Schema::TYPE_STRING.'(1000)');
    }

    public function down()
    {
        echo "m150614_182719_alter_table_file cannot be reverted.\n";

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
