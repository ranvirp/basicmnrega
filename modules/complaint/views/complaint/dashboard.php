<?php
use app\modules\complaint\models\Complaint;
use app\modules\complaint\models\WorkDemand;

use yii\helpers\Url;
use app\modules\users\models\Designation;

?>
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaint::count1(); ?></div>
                                    <div><?php echo Yii::t('app','complaint'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='<?php echo Url::to(['/landdisputes/my']);?>'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>&nbsp;
                                <a href='<?php echo Url::to(['/landdisputes/myPdf?o=']).Designation::getDesignationByUser(Yii::$app->user->id);?>'><i class="fa fa-file-pdf-o"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo WorkDemand::count1(true); ?></div>
                                    <div>Urgent <?php echo Yii::t('app','Work Demand'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='<?= Url::to(["/landdisputes/my?p=1"])?>'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaint::count1();?></div>
                                    <div><?php echo Yii::t('app','complaint');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='<?php echo Url::to(['/complaint/my']);?>'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>&nbsp;
                                <a href='<?php echo Url::to(['/complaint/myPdf?o=']).Designation::getDesignationByUser(Yii::$app->user->id);?>'><i class="fa fa-file-pdf-o"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaint::count1(true);?></div>
                                    <div>Urgent <?php echo Yii::t('app','complaint');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='<?= Url::to(['/complaint/my?p=1'])?>'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Workdemand::count1(false,true); ?></div>
                                    <div>Disposed <?php echo Yii::t('app','Landdisputes'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='<?Url::to(["/landdisputes/my?s=1"])?>'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Workdemand::count1(true,true); ?></div>
                                    <div>Disposed Urgent <?php echo Yii::t('app','Landdisputes'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='
                                <?php echo Url::to(["/landdisputes/my?p=1&s=1"]);?>
                                '><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               