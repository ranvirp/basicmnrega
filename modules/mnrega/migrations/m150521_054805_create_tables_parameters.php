<?php

use yii\db\Schema;
use yii\db\Migration;

class m150521_054805_create_tables_parameters extends Migration
{
    public function safeUp()
    {
 
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable('{{%parameter}}', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_INTEGER.' default 0',
            'link'=>Schema::TYPE_STRING,
            'parser'=>Schema::TYPE_TEXT,
            'name_hi'=>Schema::TYPE_STRING,
            'name_en'=>Schema::TYPE_STRING,
            'shortcode'=>Schema::TYPE_STRING,
            'description'=>Schema::TYPE_STRING,
            'weight'=>Schema::TYPE_INTEGER,
            'unit'=>Schema::TYPE_STRING,
            'periodicity'=>Schema::TYPE_INTEGER.' default 1',
            
                    ], $tableOptions);
        $this->createTable('{{%parameter_value}}', [
            'id' => Schema::TYPE_PK,
            'parameter_id' => Schema::TYPE_INTEGER,
            'district_id'=>Schema::TYPE_STRING,
            'parameter_value'=>Schema::TYPE_STRING,
            'update_time'=>Schema::TYPE_INTEGER,
            
                    ], $tableOptions);
        $this->createTable('{{%parameter_parse}}', [
            'id' => Schema::TYPE_PK,
            'parameter_id' => Schema::TYPE_INTEGER,
            'json_value'=>Schema::TYPE_TEXT,
            'dld_data'=>Schema::TYPE_TEXT,
            'district_code'=>Schema::TYPE_STRING.'(4)',
            'update_time'=>Schema::TYPE_INTEGER,
            'upload_time'=>Schema::TYPE_INTEGER,
            
                    ], $tableOptions);
         $this->createTable('{{%parameter_target}}', [
            'id' => Schema::TYPE_PK,
            'parameter_id' => Schema::TYPE_INTEGER,
            'district_id'=>Schema::TYPE_STRING,
            'parameter_target'=>Schema::TYPE_STRING,
            'month'=>Schema::TYPE_INTEGER,
            
                    ], $tableOptions);
                    
        $this->addForeignKey('parameter_value_fkey','{{%parameter_value}}','parameter_id','{{%parameter}}','id');
        $this->addForeignKey('parameter_target_fkey','{{%parameter_target}}','parameter_id','{{%parameter}}','id');
        $this->addForeignKey('parameter_parse_fkey','{{%parameter_parse}}','parameter_id','{{%parameter}}','id');
        
           
    }

    public function safeDown()
    {
       $this->dropForeignKey('parameter_parse_fkey','{{%parameter_parse}}');
       
       $this->dropForeignKey('parameter_value_fkey','{{%parameter_value}}');
       $this->dropForeignKey('parameter_target_fkey','{{%parameter_target}}');
       
       $this->dropTable('{{%parameter}}');
       $this->dropTable('{{%parameter_target}}');
       $this->dropTable('{{%parameter_value}}');
       $this->dropTable('{{%parameter_parse}}');
       return true;
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
