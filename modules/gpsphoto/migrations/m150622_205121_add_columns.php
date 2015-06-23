<?php

use yii\db\Schema;
use yii\db\Migration;

class m150622_205121_add_columns extends Migration
{
    public function up()
    {
  $this->addColumn('{{%photo}}','district',Schema::TYPE_TEXT);
  $this->addColumn('{{%photo}}','block',Schema::TYPE_TEXT);
  
  $this->addColumn('{{%photo}}','panchayat',Schema::TYPE_TEXT);
  
    }

    public function down()
    {
        echo "m150622_205121_add_columns cannot be reverted.\n";

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
