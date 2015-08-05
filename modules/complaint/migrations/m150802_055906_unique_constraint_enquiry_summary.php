<?php

use yii\db\Schema;
use yii\db\Migration;

class m150802_055906_unique_constraint_enquiry_summary extends Migration
{
    public function safeUp()
    {
     // $this->addConstraint('unique_marking_id','{{%enquiryreport_summary}}','unique','marking_id');
       // $this->addConstraint('unique_marking_id_enqpoint','{{%enquiryreport_point}}','unique','marking_id,complaint_point_id');
   
    }

    public function down()
    {
        echo "m150802_055906_unique_constraint_enquiry_summary cannot be reverted.\n";

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
