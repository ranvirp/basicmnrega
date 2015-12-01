<?php

use yii\db\Schema;
use yii\db\Migration;

class m150910_185202_create_format_tables extends Migration
{
/*
  Each format would consist of {{format_parameter}}. A format parameter 
  shall be qualified by bindings. Bindings shall be either district,block,
  financial year, scheme, or unique number. A binding shall be a class 
  implementing some interface having functions like values,....
  A format_parameter, binding table would map binding of a format_parameter 
  and binding. Similarly, a format, binding would contain mapping of format
  with binding. A format, parameter mapping would be captured in another table.
  So there are following tables:
      {{format_parameter}}
      attributes : name, type (string,numeric or dropdown), values}
      {{binding}}
      attributes:name,values
      {format_parameter__binding}} 
      attributes:format_parameter_id, binding_id
      {format_parameter__value}
      attributes: format_parameter_id,bindingid1,bindingid1value, bindingid2,
      bindingid2value, bindingid3value, bindingid4, bindingid4value, value 
      {format__format_parameter}
      attributes: formatid,parameterid
         
      

*/
    public function safeUp()
    {
      /*
       $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
         $this->createTable('{{%format_parameter}}', [
            'id' => Schema::TYPE_PK,
            'name_hi' => Schema::TYPE_STRING.'(255) NOT NULL',
            
              ], $tableOptions);
              */
    }

    public function down()
    {
        echo "m150910_185202_create_format_tables cannot be reverted.\n";

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
