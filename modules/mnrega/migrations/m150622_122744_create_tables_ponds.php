<?php

use yii\db\Schema;
use yii\db\Migration;

class m150622_122744_create_tables_ponds extends Migration
{
    public function safeUp()
    {
     $tableOptions=null;
             if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
               $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
         $this->createTable('{{%pond}}', [
            'workid'=>Schema::TYPE_STRING.' PRIMARY KEY NOT NULL',
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'district_code'=>Schema::TYPE_STRING,
            'block_code'=>Schema::TYPE_STRING,
            'panchayat_code'=>Schema::TYPE_STRING.' DEFAULT NULL',
            'village'=>Schema::TYPE_STRING,
            'gatasankhya'=>Schema::TYPE_STRING,
            'totarea'=>Schema::TYPE_STRING,
            'estcost'=>Schema::TYPE_DOUBLE,
            'persondays'=>Schema::TYPE_INTEGER,
             'gpslat'=>Schema::TYPE_DOUBLE,
             'gpslong'=>Schema::TYPE_DOUBLE,
             'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'remarks'=>Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by'=>Schema::TYPE_INTEGER,
            'updated_by'=>Schema::TYPE_INTEGER,
        ], $tableOptions);
     $this->addForeignKey('pond_panchayat_fkey','{{%pond}}','panchayat_code','{{%panchayat}}','code');
      $this->addForeignKey('pond_district_fkey','{{%pond}}','district_code','{{%district}}','code');
      $this->addForeignKey('pond_block_fkey','{{%pond}}','block_code','{{%block}}','code');
      
    }

    public function safeDown()
    {
        $this->dropTable('{{%ponds}}');

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
