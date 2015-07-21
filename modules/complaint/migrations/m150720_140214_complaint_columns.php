<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_140214_complaint_columns extends Migration
{
    public function up()
    {
      $this->alterColumn('{{%complaint}}','fname',Schema::TYPE_STRING.'(255) NULL');
      
      $this->alterColumn('{{%complaint}}','block_code',Schema::TYPE_STRING.'(12) NULL');
      $this->alterColumn('{{%complaint}}','panchayat_code',Schema::TYPE_STRING.'(12) NULL');

    }

    public function down()
    {
        echo "m150720_140214_complaint_columns cannot be reverted.\n";

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
