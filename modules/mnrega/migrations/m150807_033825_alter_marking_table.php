<?php

use yii\db\Schema;
use yii\db\Migration;

class m150807_033825_alter_marking_table extends Migration
{
    public function safeUp()
    {
      $this->addColumn('{{%marking}}','parentmarkingid',Schema::TYPE_INTEGER);
    }

    public function down()
    {
        echo "m150807_033825_alter_marking_table cannot be reverted.\n";

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
