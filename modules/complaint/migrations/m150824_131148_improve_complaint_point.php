<?php

use yii\db\Schema;
use yii\db\Migration;

class m150824_131148_improve_complaint_point extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%complaint_point}}','complaint_subtype','DROP NOT NULL');
    }

    public function down()
    {
        echo "m150824_131148_improve_complaint_point cannot be reverted.\n";

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
