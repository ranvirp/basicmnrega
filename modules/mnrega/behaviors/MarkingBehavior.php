<?php
namespace app\modules\mnrega\behaviors;

use yii\db\ActiveRecord;
use yii\base\Behavior;
use yii\helpers\Html;
use app\modules\mnrega\models\Marking;
use app\modules\users\models\Designation;
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

		
	
	
	public function markToDesignation($request_id,$sender,$sender_name,$sender_mobileno,$sender_designation_type_id,$receiver_designation_type_id,$receiver,$receiver_name,$receiver_mobileno,$purpose,$canmark,$status,$statustarget,$deadline,$change=0)
	 {
	            
	            //if (is_array($designation) )
	              // foreach ($designation as $id)
	               // markToDesignation($request_id,$sender,$sender_name,$sender_mobileno,$designation_type_id,$name,$mobileno,$purpose,$canmark,$status,$statustarget,$id,$deadline);
	               // if ($receiver=0)
	                  //  $rmarking=Marking::find()->where(['request_id'=>$request_id,'request_type'=>$this->request_type,'receiver_designation_type_id'=>$receiver_designation_type_id,'name'=>$name])->one();
	                 //else
	                   //$rmarking=Marking::find()->where(['request_id'=>$request_id,'request_type'=>$this->request_type,'receiver'=>$designation])->one();
	                  if (strtotime($deadline)<time())
                              $deadline=date('Y-m-d',strtotime('+7 day'));
	                 if ($sender==$receiver)
	                   {
	                     print "Marking to yourself..ridiculous..not allowed";
	                     return null;
	                     
	                     
	                   }
	                   
	                  $rmarkings=Marking::find()->where(['request_id'=>$request_id,'request_type'=>$this->request_type,'status'=>$status])->andWhere('flag!=1')->all();
	                  $rmarking=null;
	                  if ($rmarkings)
	                   {
	                     
	                     
	                     foreach ($rmarkings as $rmarking)
	                     {
	                      
	                    //print_r($rmarking->toArray());
	                     //print "already marked for this action"." cannot create new marking existing marking#".$rmarking->id.' '.$rmarking->status;
	                      if ($change=='1')
	                      {
	                       $rmarking->flag=1;$rmarking->save();
	                       } else
	                        return $rmarking;
	                       }
	                       
	                     }
	                    
	                     
	                   
	                   
	                    if ($receiver!=0)
	                    {
	                     $rmarking=Marking::find()->where(['request_id'=>$request_id,'request_type'=>$this->request_type,'receiver'=>$receiver])->one();
	                     //print "we are here";
	                     //exit;
	                     
	                     
	                     }
	                  else $rmarking=null;
	                  //print_r($rmarking);
	                 // exit;
                           if (!$rmarking)
                           {
                          // print "here";
                                $rmarking=new Marking;
                                $rmarking->created_by=Yii::$app->user->id;
                              // $rmarking->created_by=1;
                                 $rmarking->create_time=time();
                               
                          
                           }
                          
                           $rmarking->sender=$sender;
                           $rmarking->sender_designation_type_id=$sender_designation_type_id;
                           //Designation::findOne($sender)->designation_type_id;
                           
                           $rmarking->sender_name=$sender_name;
                           $rmarking->sender_mobileno=$sender_mobileno;
                           
                           $rmarking->receiver=$receiver;
                           $rmarking->receiver_designation_type_id=$receiver_designation_type_id;
                           $rmarking->receiver_name=$receiver_name;
                           $rmarking->receiver_mobileno=$receiver_mobileno;
                           $rmarking->request_id=$request_id;
                           $rmarking->request_type=$this->request_type;
                           $rmarking->deadline=$deadline;
                           $rmarking->dateofmarking=date('Y-m-d');
                           $rmarking->status=$status;
                           $rmarking->statustarget=$statustarget;
                           $rmarking->flag=0;//pending
                           $rmarking->updated_by=Yii::$app->user->id;
                          //$rmarking->updated_by=1;
                           $rmarking->update_time=time();
                           $rmarking->canmark=$canmark;
                           $rmarking->purpose=$purpose;
                          
                           if (!$rmarking->save())
                           {
                             print_r($rmarking->errors);
                             exit;
                            }
                            //else
                           // print_r($rmarking->toArray());
                           return $rmarking;
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