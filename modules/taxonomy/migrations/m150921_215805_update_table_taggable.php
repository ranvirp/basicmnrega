<?php

use yii\db\Schema;
use yii\db\Migration;

class m150921_215805_update_table_taggable extends Migration
{
    public function safeUp()
    {
      $this->alterColumn('{{%taggable}}','classname',Schema::TYPE_TEXT);
    }

    public function down()
    {
        echo "m150921_215805_update_table_taggable cannot be reverted.\n";

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
