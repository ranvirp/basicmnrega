<?php

use yii\db\Schema;
use yii\db\Migration;

class m150729_163603_alter_marking extends Migration
{
    public function safeUp()
    {
    //add five fields - name, mobileno, statustarget, purpose,canmark,
    $this->addColumn('{{%marking}}','request_type',Schema::TYPE_TEXT);
    $this->addColumn('{{%marking}}','sender_name',Schema::TYPE_TEXT);
    $this->addColumn('{{%marking}}','sender_mobileno',Schema::TYPE_STRING);
    $this->addColumn('{{%marking}}','sender_designation_type_id',Schema::TYPE_INTEGER);
   
    $this->addColumn('{{%marking}}','receiver_name',Schema::TYPE_TEXT);
    $this->addColumn('{{%marking}}','receiver_mobileno',Schema::TYPE_STRING);
    $this->addColumn('{{%marking}}','receiver_designation_type_id',Schema::TYPE_INTEGER);
   
    $this->addColumn('{{%marking}}','statustarget',Schema::TYPE_INTEGER);
    $this->addColumn('{{%marking}}','purpose',Schema::TYPE_TEXT);
    $this->addColumn('{{%marking}}','canmark',Schema::TYPE_INTEGER);
    
    $this->addColumn('{{%marking}}','created_by',Schema::TYPE_INTEGER);
    $this->addColumn('{{%marking}}','updated_by',Schema::TYPE_INTEGER);
   
    $this->createIndex('marking_indices','{{%marking}}',['request_id','request_type']);
    $this->createIndex('designation_type_indices','{{%marking}}',['receiver_designation_type_id']);
   

    }

    public function down()
    {
        echo "m150729_163603_alter_marking cannot be reverted.\n";

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
