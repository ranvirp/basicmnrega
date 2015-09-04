<?php
use app\modules\mnrega\models\Marking;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\Complaint;
use app\modules\users\models\Designation;
use yii\helpers\Url;
     if(Yii::$app->user->can('complaintagent'))
     {
    // $ms=-1,$d=-1,$s=-1,$count=true,$dcode=null,$bcode=null,$sender=-1,$allflags=false,$enqrofficer=false,$atrofficer=false)
 
        $complaintcount_unmarked=Complaint::count1(-1,-1,-1,true,null,null,-1,true,true,true);
     $jobcarddemandcount_unmarked=JobcardDemand::count1(-2);
     $workdemandcount_unmarked=WorkDemand::count1(-2);
     ?>
            <section class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$complaintcount_unmarked+$workdemandcount_unmarked+$jobcarddemandcount_unmarked?>
                            </span>
                             <?=Yii::t('app','Unmarked')?>
                            </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms=-1&enqrofficer=true&atrofficer=true'])?>'>
                                <span class="badge pull-right">
                           <?=$complaintcount_unmarked?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?ms='.urlencode('-2')])?>'>
                                <span class="badge pull-right">
                           <?=$workdemandcount_unmarked?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/jobcarddemand/my?ms='.urlencode('-2')])?>'>
                                <span class="badge pull-right">
                           <?=$jobcarddemandcount_unmarked?>
                            </span>
                             <?=Yii::t('app','Jobcarddemand')?>
                             </a>
                      </li>
                       
                    </ul>
                </div>
                </section>
               
    <?php };?>