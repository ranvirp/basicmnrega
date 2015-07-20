<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_072730_newlevels_websitemanagement extends Migration
{
    public function safeUp()
    {
       $this->batchInsert('{{%websitemanagement}}',['name_en','name_hi','code'],[['No 1','No 1','no1'],['No 2','No 2','no2'],['No 3','No 3','no3'],['No 4','No 4','no4']]);
    }

    public function down()
    {
        echo "m150720_072730_newlevels_websitemanagement cannot be reverted.\n";

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
