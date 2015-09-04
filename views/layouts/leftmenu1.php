 <?php
 if(Yii::$app->user->can('complaintadmin'))
       $d=-1;
    else
       $d=Designation::getDesignationByUser(Yii::$app->user->id);
     $counts=Marking::count1(['complaint','workdemand','jobcarddemand'],[0,1,2],$d);
      $complaintcount=$counts[0]['complaint_count'];
     $workdemandcount=$counts[0]['workdemand_count'];
     $jobcarddemandcount=$counts[0]['jobcarddemand_count'];
    
     $complaintcount0=$counts[0]['complaint_count_0'];
     $workdemandcount0=$counts[0]['workdemand_count_0'];
     $jobcarddemandcount0=$counts[0]['jobcarddemand_count_0'];
     
     $complaintcount1=$counts[0]['complaint_count_1'];
     $workdemandcount1=$counts[0]['workdemand_count_1'];
     $jobcarddemandcount1=$counts[0]['jobcarddemand_count_1'];

     $complaintcount2=$counts[0]['complaint_count_2'];
     $workdemandcount2=$counts[0]['workdemand_count_2'];
     $jobcarddemandcount2=$counts[0]['jobcarddemand_count_2'];
    

    ?>
    <div class="col-md-offest-1 col-md-3">
 <?php    if (!Yii::$app->user->can('complaintagent'))
   {?>
            <section class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$complaintcount0+$workdemandcount0+$jobcarddemandcount0?>
                            </span>
                             <?=Yii::t('app','Pending')?>
                            </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms=0&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$complaintcount0?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?ms=0&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$workdemandcount0?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/jobcarddemand/my?ms=0&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$jobcarddemandcount0?>
                            </span>
                             <?=Yii::t('app','Jobcarddemand')?>
                             </a>
                      </li>
                       
                    </ul>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                            <a>
                                <span class="badge pull-right">
                           <?=$complaintcount2+$workdemandcount2+$jobcarddemandcount2?>
                            </span>
                             <?=Yii::t('app','Report Submitted')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms=2&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$complaintcount2?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?ms=2&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$workdemandcount2?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/jobcarddemand/my?ms=2&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$jobcarddemandcount2?>
                            </span>
                             <?=Yii::t('app','Jobcarddemand')?>
                             </a>
                      </li>
                       
                    </ul>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$complaintcount1+$workdemandcount1+$jobcarddemandcount1?>
                            </span>
                             <?=Yii::t('app','Disposed')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms=1&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$complaintcount1?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?ms=1&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$workdemandcount1?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/jobcarddemand/my?ms=1&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$jobcarddemandcount1?>
                            </span>
                             <?=Yii::t('app','Jobcarddemand')?>
                             </a>
                      </li>
                       
                    </ul>
                </div>
                      <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                    <li  class="active">
                    <a>
                                <span class="badge pull-right">
                           <?=$complaintcount+$workdemandcount+$jobcarddemandcount?>
                            </span>
                             <?=Yii::t('app','Total')?>
                    </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms=-1&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$complaintcount?>
                            </span>
                             <?=Yii::t('app','Complaints')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/workdemand/my?ms=-1&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$workdemandcount?>
                            </span>
                             <?=Yii::t('app','Work Demand')?>
                             </a>
                      </li>
                       <li  class="">
                            <a href='<?=Url::to(['/complaint/complaint/my?ms=-1&d='.$d])?>'>
                                <span class="badge pull-right">
                           <?=$jobcarddemandcount?>
                            </span>
                             <?=Yii::t('app','Jobcarddemand')?>
                             </a>
                      </li>
                       
                    </ul>
                </div>
              
            </section>
            <?php } ?>

            </div>