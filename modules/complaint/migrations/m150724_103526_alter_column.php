<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_103526_alter_column extends Migration
{
    public function up()
    {
      $this->alterColumn("{{%enquiryreport_point}}","amountfrom",Schema::TYPE_TEXT);
    }

    public function down()
    {
        echo "m150724_103526_alter_column cannot be reverted.\n";

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
