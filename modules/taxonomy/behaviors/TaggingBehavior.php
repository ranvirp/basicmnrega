<?php
namespace app\modules\taxonomy\behaviors;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\modules\taxonomy\models\Tagging;
use app\modules\taxonomy\models\Taggable;
use Yii;

class TaggingBehavior extends Behavior
{
  public $term_prefix;
  public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave($event)
    {
        $terms =Yii::$app->request->post("Terms");
        $terms=$terms[$this->term_prefix];
       // print_r(get_class($event->sender));
        //exit;
        //print_r($terms);

        if (!$terms)
         return;
        $taggedtype=Taggable::find()->where(['classname'=>get_class($event->sender)])->one();
       // print_r($taggedtype);
        if ($taggedtype)
          {
           //check if term exists
           foreach ($terms as $term)
           {
           $tagging=Tagging::find()->where(['taggedtype'=>$taggedtype->shortname,'termcode'=>$term])->one();
           if (!$tagging)
            {
              $tagging=new Tagging;
              $tagging->taggedtype=$taggedtype->shortname;
              $x=$event->sender->getPrimaryKey();
              //print_r($x);
              //exit;
              $tagging->taggedtypepk="$x";
              $tagging->termcode=$term;
            //  print_r($tagging);
              if (!$tagging->save())
                {
                print_r($tagging->errors);
                exit;
                }
                
            }
            }
          }
    }
    

}
?>