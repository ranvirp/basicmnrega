<?php

use yii\db\Schema;
use yii\db\Migration;

class m150529_193313_alter_table_photo extends Migration
{
    public function up()
    {
       $this->alterColumn('{{%photo}}','thumbnail','text');
    }

    public function down()
    {
        echo "m150529_193313_alter_table_photo cannot be reverted.\n";

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
