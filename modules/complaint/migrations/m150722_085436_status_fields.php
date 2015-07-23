<?php

use yii\db\Schema;
use yii\db\Migration;

class m150722_085436_status_fields extends Migration
{
    public function up()
    {
      $this->addColumn('{{%workdemand}}','status',Schema::TYPE_INTEGER);
        $this->addColumn('{{%jobcarddemand}}','status',Schema::TYPE_INTEGER);

    }

    public function down()
    {
      
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
