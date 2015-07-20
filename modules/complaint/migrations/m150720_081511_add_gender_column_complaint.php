<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_081511_add_gender_column_complaint extends Migration
{
    public function up()
    {
       $this->addColumn('{{%complaint}}','gender',Schema::TYPE_STRING.'(1)');
    }

    public function down()
    {
        echo "m150720_081511_add_gender_column_complaint cannot be reverted.\n";

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
