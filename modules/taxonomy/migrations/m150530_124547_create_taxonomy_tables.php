<?php

use yii\db\Schema;
use yii\db\Migration;

class m150530_124547_create_taxonomy_tables extends Migration
{
    public function safeUp()
    {
       $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
         $this->createTable('{{%vocabulary}}', [
            'vocabcode' => Schema::TYPE_STRING.'(20) NOT NULL PRIMARY KEY',
            'vocabname' => Schema::TYPE_STRING . '(150) NOT NULL',
            
                    ], $tableOptions);
         $this->createTable('{{%term}}', [
            'termcode' => Schema::TYPE_STRING.'(20) NOT NULL PRIMARY KEY',
            'vocabcode' => Schema::TYPE_STRING . '(20) NOT NULL',
            'termname'=>Schema::TYPE_STRING.'(150) NoT NULL',
            
                    ], $tableOptions);
        $this->createTable('{{%taggable}}',[
          'shortname'=>Schema::TYPE_STRING.'(20) NOT NULL PRIMARY KEY',
          'classname'=>Schema::TYPE_STRING,
         ], $tableOptions);
        $this->createTable('{{%tagging}}', [
            'taggedtype' => Schema::TYPE_STRING.'(20)',
            'taggedtypepk' => Schema::TYPE_STRING . '(20) NOT NULL',
            'termcode'=>Schema::TYPE_STRING.'(20) NOT NULL',
            
                    ], $tableOptions);
        $this->addForeignKey('term_vocabulary_fkey','{{%term}}','vocabcode','{{%vocabulary}}','vocabcode');
        $this->addForeignKey('tagging_tagged_fkey','{{%tagging}}','taggedtype','{{%taggable}}','shortname');
        $this->addForeignKey('tagging_term_fkey','{{%tagging}}','termcode','{{%term}}','termcode');
        
    }

    public function safeDown()
    {
         $this->dropTable('{{%vocabulary}}');
         $this->dropTable('{{%term}}');
         $this->dropTable('{{%taggable}}');
         $this->dropTable('{{%tagging}}');
         $this->dropForeignKey('term_vocabulary_fkey','{{%term}}');
         $this->dropForeignKey('tagging_tagged_fkey','{{%tagging}}');
         $this->dropForeignKey('tagging_term_fkey','{{%tagging}}');
          
        
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
