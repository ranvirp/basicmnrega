<?php
namespace app\tests\unit\faker\providers;
use Yii;
 class Complaint extends \Faker\Provider\Base
 {
 
   
   function getRandomBlockCode()
    {
      $blocks=json_decode(file_get_contents(Yii::getAlias('@app').'/web/jsons/block.json'),TRUE);
      $block= self::randomElements(array_keys($blocks),1);
     
      $block_code=$block[0];
      return $block_code;
    }
    function getRandomPanchayat($block_code)
    {
      $panchayats=json_decode(file_get_contents(Yii::getAlias('@app').'/web/jsons/'.$block_code.'.json'),TRUE);
      $panchayat_array=self::randomElements(array_keys($panchayats),1);
      $panchayat_code=$panchayat_array[0];
      $panchayat_name=$panchayats[$panchayat_code];
      return [$panchayat_code,$panchayat_name];
    }
    function getDistrictCode($block)
    {
      return substr($block,0,4);
    
    }
    function getRandomSource()
    {
      $sources=\app\modules\complaint\models\Complaint::source();
      $source=self::randomElements(array_keys($sources),1) [0];
      return $source;
    }
    function getRandomGender()
    {
      $gender=['M','F'];
      $randgender=self::randomElements($gender,1) [0];
      return $randgender;
    }
}
    

 

?>