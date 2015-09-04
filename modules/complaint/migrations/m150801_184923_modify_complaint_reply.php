<?php

use yii\db\Schema;
use yii\db\Migration;

class m150801_184923_modify_complaint_reply extends Migration
{
    public function safeUp()
    {
      $this->addColumn('{{%complaint_reply}}','complaint_id',Schema::TYPE_INTEGER);
    }

    public function down()
    {
        echo "m150801_184923_modify_complaint_reply cannot be reverted.\n";

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
