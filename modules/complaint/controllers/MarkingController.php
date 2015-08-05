<?php
namespace app\modules\complaint\controllers;
use app\modules\mnrega\models\Marking;
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\ComplaintReply;
use yii\web\NotFoundHttpException;

use app\modules\users\models\Designation;
use Yii;
class MarkingController extends \yii\web\Controller
{

   public function actionIndex($markingid)
    {
      $complaintview='';
      $actionbuttons='';
      $marking=$this->findMarking($markingid);
      $complaintview.='<div class="col-md-12">Marking Id #'.$marking->id.' marked to '.$marking->receiver_name.'</div>';
      if (Yii::$app->user->can('complaintadmin'))
         {
         $complaint=Complaint::findOne($marking->request_id);
         
         $complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view',['model'=>$complaint]);
         
          $replytype='Review';
          if (($complaint->status==Complaint::ATR_RECEIVED) ||($complaint->status==Complaint::ENQUIRY_REPORT_RECEIVED)) 
            $actionbuttons.=$this->renderPartial('actionreview',['text'=>$replytype,'id'=>$marking->request_id,'marking'=>$marking]);
            if ($markingid!=$complaint->enqrofficer)
            $actionbuttons.=$this->renderPartial('actionmarkthis',['text'=>"Mark this marking for Enquiry",'id'=>$marking->request_id,'markingid'=>$marking->id,'a'=>'e']);
             else
             $actionbuttons.='<p>'.'Assigned for Enquiry'.'</p>';
             if ($markingid!=$complaint->atrofficer)
           
            $actionbuttons.=$this->renderPartial('actionmarkthis',['text'=>"Mark this marking for ATR",'id'=>$marking->request_id,'markingid'=>$marking->id,'a'=>'a']);
           else
             $actionbuttons.='<p>'.'Assigned for ATR'.'</p>';
             
           }
           else
      if ($this->_ismarkedtocurrentuser($marking->request_id,$markingid)) 
       {
         $complaint=Complaint::findOne($marking->request_id);
         
         $complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view',['model'=>$complaint]);
         
          if ($marking->status==Complaint::PENDING_FOR_ENQUIRY)
          {
            $replytype='File Enquiry Report';
            $actionbuttons.=$this->renderPartial('actionreply',['text'=>$replytype.' for myself','id'=>$marking->request_id,'markingid'=>$marking->id]);
          
         }
           else if ($marking->status==Complaint::PENDING_FOR_ATR)
           {
            $replytype='File ATR';
            $actionbuttons.=$this->renderPartial('actionreply',['text'=>$replytype.' for myself','id'=>$marking->request_id,'markingid'=>$marking->id]);
          
            }
          $submarkings=Marking::find()->where(['sender'=>Designation::getDesignationByUser(Yii::$app->user->id),'request_type'=>'complaint','request_id'=>$marking->request_id])->andWhere('flag=0')->all();
                     
          foreach ($submarkings as $submarking)
          {
            if ($submarking->status==Complaint::PENDING_FOR_ENQUIRY)
          {
            $replytype='File Enquiry Report';
            $actionbuttons.=$this->renderPartial('actionreply',['text'=>$replytype.' for '.$submarking->receiver_name,'id'=>$marking->request_id,'markingid'=>$marking->id]);
          
         }
           else if ($marking->status==Complaint::PENDING_FOR_ATR)
           {
            $replytype='File ATR';
            $actionbuttons.=$this->renderPartial('actionreply',['text'=>$replytype.' for '.$submarking->receiver_name,'id'=>$marking->request_id,'markingid'=>$marking->id]);
          
            }  
            $reports=ComplaintReply::find()->where(['marking_id'=>$submarking->id])->andWhere(['reply_type'=>ComplaintReply::ENQUIRY_REPORT])->orWhere(['reply_type'=>ComplaintReply::ATR_REPORT])->andWhere(['accepted'=>0])->all(); 
            foreach ($reports as $report)
             {
               $actionbuttons.=$this->renderPartial('actionreview',['text'=>'Review report #'.$report->id,'reportid'=>$report->id,'markingid'=>$submarking->id]);
              
             }
          }
                
          
        }   
       return $this->renderAjax('controlpanel',['complaintview'=>$complaintview,'actionbuttons'=>$actionbuttons]);
    
    }
    public function actionComplaint($id,$markingid=0)
     {
     
      
      $complaintview='';
      $actionbuttons='';
      $complaint=Complaint::findOne($id);
      $this->_removeInconsistencies($complaint);
      $complaintview.= $this->renderPartial('@app/modules/complaint/views/complaint/view',['model'=>$complaint]);
       $actionbuttons='<div id="complaint-status-div">'.Complaint::statusNames()[$complaint->status].'</div>';  
     // $complaintview.='<div class="col-md-12">Complaint Id #'.$complaint->id.' marked to '.$complaint->receiver1?$complaint->receiver1->name_hi.'</div>';
      if (Yii::$app->user->can('complaintadmin'))
         {
            $actionbuttons.='<p class="bg-success"><strong>'.Yii::t('app','Enquiry Officer').'</strong></p>';
            $enqrofficermarking=$complaint->enquiryOfficer;
            $enqrofficername=$enqrofficermarking?$enqrofficermarking->receiver_name:'';
            $actionbuttons.='<p>'.$enqrofficername;
            if ($enqrofficermarking!=null)
              $actionbuttons.='<span class="pull-right">'.$this->renderPartial('actionmarkofficer',['text'=>Yii::t("app","Change"),'id'=>$id,'a'=>'e','change'=>1]).'</span>';
           else
              $actionbuttons.='<span>'.Yii::t('app','Nobody').'</span>'.'<span class="pull-right">'.$this->renderPartial('actionmarkofficer',['text'=>Yii::t("app","Appoint"),'id'=>$id,'a'=>'e']).'</span>';
            $actionbuttons.='<p class="bg-success"><strong>'.Yii::t('app','ATR Officer').'</strong></p>';
            $atrofficermarking=$complaint->atrOfficer;
            $atrofficername=$atrofficermarking?$atrofficermarking->receiver_name:'';
            $actionbuttons.='<p>'.$atrofficername;
            if ($atrofficermarking!=null)
              $actionbuttons.='<span class="pull-right">'.$this->renderPartial('actionmarkofficer',['text'=>Yii::t("app","Change"),'id'=>$id,'a'=>'a','change'=>1]).'</span>';
           else
              $actionbuttons.='<span>'.Yii::t('app','Nobody').'</span>'.'<span class="pull-right">'.$this->renderPartial('actionmarkofficer',['text'=>Yii::t("app","Appoint"),'id'=>$id,'a'=>'a']).'</span>';

            $actionbuttons.='</p>';
            $replytype='Review';
         
  
            if ($complaint->status==Complaint::ATR_RECEIVED)
             {
              $actionbuttons.=$this->renderPartial('actiondispose',['text'=>"Mark as Disposed",'id'=>$id]);
              
              }
              else if ($complaint->status==Complaint::ENQUIRY_REPORT_RECEIVED)
              {
              
              
              }

             
           }
        
       return $this->renderAjax('controlpanel',['complaintview'=>$complaintview,'actionbuttons'=>$actionbuttons]);
    
    }
    public function actionReview($id,$markingid,$accept=1)
  {
     if (!Yii::$app->user->can('complaintadmin'))
       throw new NotFoundHttpException('Not Allowed');
     $complaint=Complaint::findOne($id);
     if (($complaint->atrofficer!=$markingid) && ($complaint->enqrofficer!=$markingid) )
      return "Inconsistent..first assign him as enquiry officer";
    $marking=Marking::findOne($markingid);
       $transaction= Yii::$app->db->beginTransaction();
   try
   {
       if ($accept==0)
       {
       $model=new ComplaintReply;
    
    $model->marking_id=$markingid;
    $model->complaint_id=$id;
    
    if ($model->load(Yii::$app->request->bodyParams) )
     {
      
      $model->created_at=time();
      $model->updated_at=time();
      $model->author=Yii::$app->user->id;
      if (!$model->save())
       print_r($model->errors);
       }
       }
      if ($complaint)
       {
          if ($complaint->status==Complaint::ATR_RECEIVED)
           {
             if ($accept==1)
              {
                 $complaint->status=Complaint::DISPOSED;
                 $complaint->save();
                 $marking=Marking::findOne($complaint->atrofficer);
                 $marking->flag=1;//disposed
                 $marking->save();
              }
              else
               {
                 $complaint->status=Complaint::PENDING_FOR_ATR;
                 $complaint->save();
                 $marking=Marking::findOne($complaint->atrofficer);
                 $marking->status=Complaint::PENDING_FOR_ATR;
                 $marking->statustarget=Complaint::ATR_RECEIVED;
                 $marking->flag=0;//pending
                 $marking->save();
               
               }
               }
               else  if ($complaint->status==Complaint::ENQUIRY_REPORT_RECEIVED)
           {
             if ($accept==1)
              {
                 if (is_numeric($complaint->atrofficer))
                    $complaint->status=Complaint::PENDING_FOR_ATR;
                 else
                    $complaint->status=Complaint::ENQUIRY_REPORT_REVIEWED;
                 $complaint->save();
                 $marking=Marking::findOne($complaint->enqrofficer);
                 $marking->flag=1;//disposed
                 $marking->save();
              }
              else
               {
                 $complaint->status=Complaint::PENDING_FOR_ENQUIRY;
                 $complaint->save();
                 $marking=Marking::findOne($complaint->enqrofficer);
                 $marking->status=Complaint::PENDING_FOR_ENQUIRY;
                 $marking->statustarget=Complaint::ENQUIRY_REPORT_RECEIVED;
                 $marking->flag=0;//pending
                 $marking->save();
               
               }
               }
               $transaction->commit();
          }
           }
           catch (Exception $e) {$transaction->rollBack();}      
             return $this->renderAjax('review',['id'=>$id,'marking'=>$marking,'accept'=>$accept]);
           
       
       }
  
  
 protected function _ismarkedtocurrentuser($id,$markingid)
  {
   if ($markingid==0) return false;
    $marking1=Marking::find()->where(['id'=>$markingid,'request_id'=>$id,'receiver'=>Designation::getDesignationByUser(Yii::$app->user->id)])->one();
    $marking2=Marking::find()->where(['id'=>$markingid,'request_id'=>$id,'sender'=>Designation::getDesignationByUser(Yii::$app->user->id)])->one();
    return $marking1 or $marking2;
  }
  
  protected function findMarking($markingid)
   {
     if (($model=Marking::findOne(['id'=>$markingid])) !=null)
      {
        if ($model->request_type=='complaint')
        return $model;
        else
          throw new \yii\web\NotFoundHttpException("Not found");
        
      }
     else
       throw new \yii\web\NotFoundHttpException("Not found");
   
   }
   public function actionMarkthis($id,$markingid,$a='e')
   {
     if (!Yii::$app->user->can('complaintadmin'))
      return "Not Allowed";
     $complaint=Complaint::findOne($id);
     if ($a=='e')
     $complaint->enqrofficer=$markingid;
     else if ($a=='a')
     $complaint->atrofficer=$markingid;
     $complaint->save();
     return "done";
     
     
   
   }
   public function action1Forward($id,$markingid,$newmarkingid)
   {
     
     $marking2=Marking::find()->where(['id'=>$markingid,'request_id'=>$id,'sender'=>Designation::getDesignationByUser(Yii::$app->user->id)])->one();
     
     if ($marking2 ||Yii::$app->user->can('complaintadmin'))
     {
      $transaction=Yii::$app->db->beginTransaction();
      $flag=true;
       $marking=Marking::findOne($newmarkingid);
       if (!$marking)
        throw new NotFoundHttpException('Wrong request');
        $eq=EnquiryReportSummary::findOne(['marking_id'=>$markingid]);
        if ($eq)
        {
          $eq->accepted=1;
          $eq->save();
        }
        $eqclone=EnquiryReportSummary::findOne(['marking_id'=>$newmarkingid]);
        if (!$eqclone) $eqclone= new EnquiryReportSummary;
        $eqclone->attributes=$eq->attributes;
       // unset($eqclone->id);
        
        $eqclone->reportby="Recommended by :".$marking->receiver_name."\n".$eqclone->reportby;
        $eqclone->marking_id=$newmarkingid;
        $eqclone->accepted=0;
        if (!$eqclone->save())
        {
         print_r($eqclone->errors);
         //exit;
         $flag=false;
        
         
        }
        else 
        {
          //print_r($eqclone);
         // exit;
        }
        
       // print_r($eqclone->reportby);
        //exit;
        
         $erp=EnquiryReportPoint::find()->where(['marking_id'=>$markingid])->all();
        if ($erp)
        {
        foreach ($erp as $eqpoint)
        {
          $eqpoint->accepted=1;
          $eqpoint->save();
           $eqpointclone=EnquiryReportPoint::findOne(['marking_id'=>$newmarkingid,'complaint_point_id'=>$eqpoint->complaint_point_id]);
        if (!$eqpointclone) $eqpointclone=new EnquiryReportPoint;
          $eqpointclone->attributes=$eqpoint->attributes;
          unset($eqpointclone->id);
        
        $eqpointclone->marking_id=$newmarkingid;
        $eqpointclone->accepted=0;
       if (! $eqpointclone->save())
         {
          print_r($eqpointclone->errors);
         // exit;
          $flag=false;
         }
        }
        }
       if ($flag)
       {
        $transaction->commit();
        return $this->redirect(\yii\helpers\Url::to(['/complaint/complaint/filereport?id='.$id.'&markingid='.$newmarkingid]));
     
        }
        else
        {
         $transaction->rollBack();
         return "some error";
         }
       //$marking->status=Complaint::ENQUIRY_REPORT_RECEIVED;
       //$marking->purpose='Report Forwarded';
       //$marking->save();
       
     }
     }
   protected function _removeInconsistencies($complaint)
   {
    //All markings which is more advanced than current status of complaint shall be deactivated
     $markings=Marking::find()->where('status>'.$complaint->status)->all(); 
     foreach ($markings as $marking)
     {
       $marking->flag=1; //deactivate marking
       $marking->save();
     
     }
   
   }
  
   
  



}