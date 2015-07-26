<?php

use yii\db\Schema;
use yii\db\Migration;

class m150725_195544_enquiry_reports_new_columns extends Migration
{
    public function safeUp()
    {
       $this->addColumn('{{%enquiryreport_summary}}','marking_id',Schema::TYPE_INTEGER);
       $this->addColumn('{{%enquiryreport_point}}','marking_id',Schema::TYPE_INTEGER);
        $this->addColumn('{{%atr_summary}}','marking_id',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_point}}','marking_id',Schema::TYPE_INTEGER);
       
    }

    public function down()
    {
        echo "m150725_195544_enquiry_reports_new_columns cannot be reverted.\n";

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
