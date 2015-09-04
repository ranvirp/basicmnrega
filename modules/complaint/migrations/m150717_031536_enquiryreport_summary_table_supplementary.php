<?php

use yii\db\Schema;
use yii\db\Migration;

class m150717_031536_enquiryreport_summary_table_supplementary extends Migration
{
    public function safeUp()
    {
       $this->addColumn('{{%enquiryreport_summary}}','reportby',Schema::TYPE_TEXT);
    }

    public function down()
    {
        echo "m150717_031536_enquiryreport_summary_table_supplementary cannot be reverted.\n";

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
