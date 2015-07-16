<?php
namespace app\modules\reply\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\helpers\Html;

class FileAttachmentBehavior extends Behavior
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
	if (!is_array($event->sender->$attribute))
	{
	  $event->sender->$attribute=explode(",",$event->sender->$attribute);
	}
	//exit;
	 if (count($event->sender->$attribute)>0)
			{
			$x=[];
			foreach ($event->sender->$attribute as $attachment)
			  if(is_numeric($attachment)) $x[]=$attachment; //remove blank fields
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
				$fileids = explode(",",$event->sender->$attribute);
				foreach ($fileids as $fileid)
				{
				   if (!is_numeric($fileid)) continue;
					$file = \app\modules\reply\models\File::findOne($fileid);
					if ($file)
					{
						$file->model_type=get_class($event->sender);
						$file->model_pk = $event->sender->id;
						$file->save();
					}
				}
			}
	 
	}
}