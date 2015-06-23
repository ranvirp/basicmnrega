<?php

use yii\db\Schema;
use yii\db\Migration;

class m150614_183308_alter_table_file_1 extends Migration
{
    public function up()
    {
     $this->addColumn('{{%file}}','uniqid',Schema::TYPE_STRING.'(1000) default NULL');
    }

    public function down()
    {
        echo "m150614_183308_alter_table_file_1 cannot be reverted.\n";

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
