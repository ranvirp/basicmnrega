<?php

use yii\db\Schema;
use yii\db\Migration;

class m150802_131637_modify_complaint_reply extends Migration
{
    public function safeUp()
    {
       $this->addColumn('{{%complaint_reply}}','complainttrue',Schema::TYPE_INTEGER);
       $this->addColumn('{{%complaint_reply}}','amountinvolved',Schema::TYPE_DOUBLE);
       $this->addColumn('{{%complaint_reply}}','firproposed',Schema::TYPE_INTEGER);
       $this->addColumn('{{%complaint_reply}}','daproposed',Schema::TYPE_INTEGER);
       $this->addColumn('{{%complaint_reply}}','firdone',Schema::TYPE_INTEGER);
       $this->addColumn('{{%complaint_reply}}','dadone',Schema::TYPE_INTEGER);
       $this->addColumn('{{%complaint_reply}}','amountrecovered',Schema::TYPE_DOUBLE);
       
    }

    public function down()
    {
        echo "m150802_131637_modify_complaint_reply cannot be reverted.\n";

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
