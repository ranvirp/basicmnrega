<?php

use yii\db\Schema;
use yii\db\Migration;

class m150730_031734_complaint_table_modify extends Migration
{
    public function safeUp()
    {
       $this->addColumn('{{%complaint}}','dateofcomplaint',Schema::TYPE_DATE);
        $this->addColumn('{{%complaint}}','enqrofficer',Schema::TYPE_INTEGER);
       $this->addColumn('{{%complaint}}','atrofficer',Schema::TYPE_INTEGER);
      
       $this->addColumn('{{%complaint_reply}}','accepted',Schema::TYPE_INTEGER);
       $this->addColumn('{{%enquiryreport_point}}','accepted',Schema::TYPE_INTEGER);
       $this->addColumn('{{%enquiryreport_summary}}','accepted',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_summary}}','accepted',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_point}}','accepted',Schema::TYPE_INTEGER);
       
       
    }

    public function down()
    {
        echo "m150730_031734_complaint_table_modify cannot be reverted.\n";

        return false;
    }
     public function safeDown()
    {
      $this->dropColumn('{{%complaint}}','dateofcomplaint');
    }
    
/*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
   
    */
}
