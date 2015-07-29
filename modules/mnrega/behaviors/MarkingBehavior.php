<?php
namespace app\modules\mnrega\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\helpers\Html;
use app\modules\mnrega\models\Marking;
use Yii;
class MarkingBehavior extends Behavior
{
    // ...
  public $request_type;
  public function events()
    {
        return [
           // ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
           // ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            //ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            // ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
           // ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }
/*
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
	  switch($this->request_type)
	  {
	  'complaint':
	  'workdemand':
	  'jobcarddemand':
	   if (!Yii::$app->user->can('complaintmarking'))
	      return;
	     //Now create markings
        $markings=$event->sender->marking;
        $maintype=Yii::$app->request->post('maintype');
        $deadline=$markings['deadline'];
        foreach ($maintype as $x)
            {
                switch ($x)
                    {
                       case 'po':
                        //find block -
                           $podtid=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'po'])->one()->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$podtid,'level_id'=>$event->sender->block_code])->one()->id;
                           $rmarking=Marking::find()->where(['request_id'=>$event->sender->id,'request_type'=>$this->request_type,'receiver'=>$designation])->one();
                           if (!$rmarking)
                           {
                                $rmarking=new Marking;
                           }
                           $rmarking->sender=Yii::$app->user->isGuest?0:\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->id;
                           $rmarking->receiver=$designation;
                           $rmarking->request_id=$event->sender->id;
                           $rmarking->request_type=$this->request_type;
                           $rmarking->deadline=$deadline;
                           $rmarking->dateofmarking=date('Y-m-d');
                           $rmarking->status=0;
                           $rmarking->create_time=time();
                            
                            $rmarking->save();
                         break;
                        case  'sqm':
                          if (!Yii::$app->user->can('marktosqm'))
                            break;
                        //find block -
                           $sqmdt=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>'sqm'])->one();
                           if(!$sqmdt) break;
                           $sqmdtid=$podt->id;
                           $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$sqmdtid,'level_id'=>$event->sender->district_code])->one()->id;
                           $rmarking=Marking::find()->where(['request_id'=>$event->sender->id,'request_type'=>$this->request_type,'receiver'=>$designation])->one();
                           if (!$rmarking)
                           {
                                $rmarking=new Marking;
                           }
                           $rmarking->sender=Yii::$app->user->isGuest?0:\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->id;
                           $rmarking->receiver=$designation;
                           $rmarking->request_id=$event->sender->id;
                           $rmarking->request_type=$this->request_type;
                           $rmarking->deadline=$deadline;
                           $rmarking->dateofmarking=date('Y-m-d');
                           $rmarking->status=0;
                           $rmarking->create_time=time();
                            
                            $rmarking->save();
                         break;
                         default: break;
                        }
            }
        if(!Yii::$app->user->can('marktodesignation')) break;
        if (!array_key_exists('designation',$markings) )break;
                foreach ($markings['designation'] as $x=>$marking)
                    {
                         $rmarking=new Marking;
                         $rmarking->sender=Yii::$app->user->isGuest?0:\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->id;
                         $rmarking->receiver=$marking;
                         $rmarking->request_id=$event->sender->id;
                         $rmarking->request_type=$this->request_type;
                         $rmarking->deadline=$deadline;
                         $rmarking->dateofmarking=date('Y-m-d');
                         $rmarking->status=0;
                         $rmarking->create_time=time();
                         $rmarking->save();
                     }
        }
        break;
        default:
        break;
	 
	}
	*/
	public function markToDesignation($request_id,$designation,$deadline)
	 {
	            
	            if (is_array($designation) )
	               foreach ($designation as $id)
	                markToDesignation($request_id,$id,$deadline);
	                    $rmarking=Marking::find()->where(['request_id'=>$request_id,'request_type'=>$this->request_type,'receiver'=>$designation])->one();
                           if (!$rmarking)
                           {
                                $rmarking=new Marking;
                           }
                           $rmarking->sender=Yii::$app->user->isGuest?0:\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->id;
                           $rmarking->receiver=$designation;
                           $rmarking->request_id=$request_id;
                           $rmarking->request_type=$this->request_type;
                           $rmarking->deadline=$deadline;
                           $rmarking->dateofmarking=date('Y-m-d');
                           $rmarking->status=0;
                           $rmarking->create_time=time();
                            
                            $rmarking->save();
     }
     public function markStatus($markingid,$status)
     {
         $rmarking=Marking::findOne($markingid);
         if( $rmarking)
           {
            $rmarking->status=1;
            $rmarking->save();
            }
     
     
     }
	
}