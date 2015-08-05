<?php
     if(Yii::$app->user->can('complaintagent'))
     {
        $complaintcount_unmarked=Complaint::count1(-2);
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
                            <a href='<?=Url::to(['/complaint/complaint/my?ms='.urlencode('-2')])?>'>
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