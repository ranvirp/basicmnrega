<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_210027_complaint_additional_columns extends Migration
{
    public function safeUp()
    {
      $this->addColumn('{{%complaint}}','flag',Schema::TYPE_INTEGER);
      $this->addColumn('{{%complaint}}','created_by',Schema::TYPE_INTEGER);
      $this->addColumn('{{%complaint}}','updated_by',Schema::TYPE_INTEGER);
      $this->addColumn('{{%complaint}}','created_at',Schema::TYPE_INTEGER);
      $this->addColumn('{{%complaint}}','updated_at',Schema::TYPE_INTEGER);
      
    }

    public function down()
    {
        echo "m150720_210027_complaint_additional_columns cannot be reverted.\n";

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
