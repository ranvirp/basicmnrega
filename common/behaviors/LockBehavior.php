<?php
namespace app\common\behaviors;

use yii\base\Behavior;
use app\common\models\LockObject;
use Yii;
class LockBehavior extends Behavior
{
  const LOCK_FOR_EDIT=1;
  public $object_type;
  public $object_id;
  public function lock($lock_id)
  {
    $lockObject=new LockObject;
    $lockObject->objecttype=$this->object_type;
    $lockObject->objecttype=$this->object_type;
   
    $duplicateObject->originalid=$this->original_id;
    $duplicateObject->duplicateid=$duplicate_id;
    $duplicateObject->save();
    
    
  }
  public function checkDuplicate()
  {
   
  }
  
}