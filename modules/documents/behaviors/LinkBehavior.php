<?php
namespace app\modules\documents\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\helpers\Html;

class LinkBehavior extends Behavior
{
    // ...
  public $attribute;
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
             ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }
public function beforeValidate($event)
{

}
public function beforeSave($event)
	{

	$attribute=$this->attribute;
	$links=$event->sender->$attribute;
	if (!is_array($event->sender->$attribute))
	{
	  $event->sender->$attribute=explode(",",$event->sender->$attribute);
	}
	//exit;
	 if (count($event->sender->$attribute)>0)
			{
			$x=[];
			foreach ($event->sender->$attribute as $link)
			  if(is_numeric($link)) $x[]=$link; //remove blank fields
			$event->sender->$attribute=implode(",",$x);
			}
		    else
				$event->sender->$attribute='';
			
		}
		
	
	
	
	public function afterSave($event)
	{
	$attribute=$this->attribute;
	
	 if ($event->sender->$attribute!='')
			{
				$linkids = explode(",",$event->sender->$attribute);
				foreach ($linkids as $linkid)
				{
				   if (!is_numeric($linkid)) continue;
					$link = \app\modules\documents\models\Link::findOne($linkid);
					if ($link)
					{
						$link->model_type=get_class($event->sender);
						$link->model_pk = $event->sender->id;
						$link->save();
					}
				}
			}
	 
	}
}