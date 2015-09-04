<?php

use yii\db\Schema;
use yii\db\Migration;

class m150802_131637_modify_complaint_reply extends Migration
{
    public function safeUp()
    {
       $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%enquiryreport_attributes}}', [
          'id'=>Schema::TYPE_PK,
          'complaint_id'=>Schema::TYPE_INTEGER,
          ], $tableOptions);
       $this->createTable('{{%atr_attributes}}', [
          'id'=>Schema::TYPE_PK,
          'complaint_id'=>Schema::TYPE_INTEGER,
          ], $tableOptions);
       $this->addColumn('{{%enquiryreport_attributes}}','complainttrue',Schema::TYPE_INTEGER);
       $this->addColumn('{{%enquiryreport_attributes}}','amountinvolved',Schema::TYPE_DOUBLE);
       $this->addColumn('{{%enquiryreport_attributes}}','firproposed',Schema::TYPE_INTEGER);
       $this->addColumn('{{%enquiryreport_attributes}}','daproposed',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_attributes}}','complainttrue',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_attributes}}','firdone',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_attributes}}','dadone',Schema::TYPE_INTEGER);
       $this->addColumn('{{%atr_attributes}}','amountrecovered',Schema::TYPE_DOUBLE);
       
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
