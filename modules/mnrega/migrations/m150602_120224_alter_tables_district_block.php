<?php

use yii\db\Schema;
use yii\db\Migration;

class m150602_120224_alter_tables_district_block extends Migration
{
    public function up()
    {
      $this->addColumn('{{%district}}','name_hi',Schema::TYPE_STRING);
      $this->addColumn('{{%district}}','name_en',Schema::TYPE_STRING);
      $this->addColumn('{{%district}}','code',Schema::TYPE_STRING);
      
      $this->addColumn('{{%block}}','name_hi',Schema::TYPE_STRING);
      $this->addColumn('{{%block}}','name_en',Schema::TYPE_STRING);
      $this->addColumn('{{%block}}','code',Schema::TYPE_STRING);
      
    }

    public function down()
    {
        echo "m150602_120224_alter_tables_district_block cannot be reverted.\n";

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
