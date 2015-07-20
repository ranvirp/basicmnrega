<?php

use yii\db\Schema;
use yii\db\Migration;

class m150718_041326_add_column_manualno extends Migration
{
  
       public function safeUp()
    {
       $this->addColumn('{{%complaint}}','manualno',Schema::TYPE_TEXT);
    }


    public function down()
    {
        echo "m150718_041326_add_column_manualno cannot be reverted.\n";

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
