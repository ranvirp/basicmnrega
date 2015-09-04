<?php
namespace app\common\behaviors;

use yii\base\Behavior;
use app\common\models\DuplicateObject;
use Yii;
class DuplicateBehavior extends Behavior
{
    // ...
  public $object_type;
  public $original_id;
  public function markAsDuplicate($duplicate_id)
  {
    $duplicateObject=new DuplicateObject;
    $duplicateObject->objecttype=$this->object_type;
    $duplicateObject->originalid=$this->original_id;
    $duplicateObject->duplicateid=$duplicate_id;
    $duplicateObject->save();
    
    
  }
  public function checkDuplicate()
  {
   
  }
  
}