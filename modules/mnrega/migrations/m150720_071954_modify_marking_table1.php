<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_071954_modify_marking_table1 extends Migration
{
    public function up()
    {
       $this->addColumn('{{%marking}}','status',Schema::TYPE_INTEGER);
    }

    public function down()
    {
        echo "m150720_071954_modify_marking_table1 cannot be reverted.\n";

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
