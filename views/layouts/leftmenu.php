<?php
use app\modules\mnrega\models\Marking;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\Complaint;
use app\modules\users\models\Designation;
use yii\helpers\Url;


if(Yii::$app->user->can('complaintviewall'))
       $d=-1;
    else
       $d=Designation::getDesignationByUser(Yii::$app->user->id);
     $counts=Marking::count1(['complaint','workdemand','jobcarddemand'],[0,1,2,3,4,5,6,7],$d);
   ?>
   <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$counts[0]['complaint_count']?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                            </a>
                      </li>
   <?php
   foreach (Complaint::statusNames() as $s=>$sname)
   {
   ?>
                 
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms='.$s.'&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$counts[0]['complaint_count_'.$s]?>
                            </span>
                             <?=Yii::t('app',$sname)?>
                             </a>
                      </li>
                       
                       
                 
<?php   
   }
?>
   </ul>
                </div>
   <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$counts[0]['jobcarddemand_count']?>
                            </span>
                             <?=Yii::t('app','Jobcard Demand')?>
                            </a>
                      </li>
   <?php
   foreach (JobcardDemand::statusNames() as $s=>$sname)
   {
   ?>
                 
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/jobcarddemand/my?ms='.$s.'&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$counts[0]['jobcarddemand_count_'.$s]?>
                            </span>
                             <?=Yii::t('app',$sname)?>
                             </a>
                      </li>
                       
                       
                 
<?php   
   }
?>
   </ul>
                </div>
   <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$counts[0]['workdemand_count']?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                            </a>
                      </li>
   <?php
   foreach (WorkDemand::statusNames() as $s=>$sname)
   {
   ?>
                 
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?ms='.$s.'&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$counts[0]['workdemand_count_'.$s]?>
                            </span>
                             <?=Yii::t('app',$sname)?>
                             </a>
                      </li>
                       
                       
                 
<?php   
   }
?>
   </ul>
                </div>