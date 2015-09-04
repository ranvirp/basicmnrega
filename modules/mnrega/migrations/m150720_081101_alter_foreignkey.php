<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_081101_alter_foreignkey extends Migration
{
    public function up()
    {
        $this->dropForeignKey('request_marking_fkey','{{%marking}}');
    }

    public function down()
    {
        echo "m150720_081101_alter_foreignkey cannot be reverted.\n";

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
