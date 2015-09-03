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
     $complaintcounts=Complaint::counts([]);
      $jobcarddemandcounts=JobcardDemand::counts([]);

 $workdemandcounts=WorkDemand::counts([]);
//print_r( $workdemandcounts);
   ?>
   <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$complaintcounts[0]['complaint_count']?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                            </a>
                      </li>
   <?php
   foreach (Complaint::statusNames() as $s=>$sname)
   {
   ?>
                 
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/index?s='.$s.'&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=
                           $complaintcounts[0]['complaint_count_'.$s]
                           ?>
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
                           <?=$jobcarddemandcounts[0]['jobcarddemand_count']?>
                            </span>
                             <?=Yii::t('app','Jobcard Demand')?>
                            </a>
                      </li>
   <?php
   foreach (JobcardDemand::statusNames() as $s=>$sname)
   {
   ?>
                 
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/jobcarddemand/my?s='.$s.'&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$jobcarddemandcounts[0]['jobcarddemand_count_'.$s]?>
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
                           <?=$workdemandcounts[0]['workdemand_count']?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                            </a>
                      </li>
   <?php
   foreach (WorkDemand::statusNames() as $s=>$sname)
   {
   
   ?>
                 
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?s='.$s.'&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$workdemandcounts[0]['workdemand_count_'.$s]?>
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
                    <a href='<?=Url::to(['/complaint/complaint/my1?flag=4'])?>'>
                                <span class="badge pull-right">
                          <?php
                            $flagcounts=Marking::countflag(['complaint'],[4]);
                           echo $flagcounts[0]['complaint_count_4'];
                           ?>
                            </span>
                             <?=Yii::t('app','Alerts')?>
                            </a>
                      </li>
                    </div>
                