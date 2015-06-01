<?php
namespace app\modules\taxonomy\behaviors;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\modules\taxonomy\models\Tagging;
use app\modules\taxonomy\models\Tagging;

class TaggingBehavior extends Behavior
{
  public $term;
  public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave($event)
    {
        $taggedtype=Taggable::find()->where(['classname'=>class_name($event->owner)])->one();
        if ($taggedtype)
          {
           //check if term exists
           $tagging=Tagging::find()->where(['taggedtype'=>$taggedtype->shortname,'termcode'=>$term])->one();
           if (!$tagging)
            {
              $tagging=new Tagging;
              $tagging->taggedtype=$taggedtype->shortname;
              $tagging->taggedid=$this->owner->getPrimaryKey();
              $tagging->save();
            }
          }
    }
    

}
?>