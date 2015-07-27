<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAsset_1;
use app\modules\mnrega\models\Marking;
use app\modules\complaint\models\JobcardDemand;
use app\modules\complaint\models\WorkDemand;
use app\modules\complaint\models\Complaint;
use app\modules\users\models\Designation;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
//\app\assets\KartikFileInputAsset::register($this);
AppAsset_1::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
     
    <?php $this->head() ?>
    <style>
    .bg-green
    {
      background-color:green;
    }
    .no-margin
    {
      margin:0;
    }
    .no-padding
    {
     padding:0;
    }
   .navbar-nav > li > a {padding-top:10px !important; padding-bottom:10px !important;color:white;}
.navbar {min-height:30px !important;font-size:8px;}
 .nav >li > a:hover, .nav >li > a:focus , .nav .open>a,.nav .open>a:hover,.nav .open>a:focus
{
 background:blue;
}
    .navbar-green
    {
     background-color:#faf3e3
    }
    .menubar
    {
     margin-bottom:15px;
     margin-top:5px;
     border:solid 1px;
     //background-color:#3c68b6;
     background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
     background-size: 100%;
     display:table;
     width:100%;
    }
    </style>
   
</head>
<body class="">

<?php $this->beginBody() ?>
<div class="wrap">
      
    <?php
        NavBar::begin([
                //'brandLabel' => 'KESCO',
                //'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions'=>['class'=>'no-padding no-margin'],
                'options' => [
                    'class' => 'navbar navbar-default no-margin',
                ],
            ]);
           // echo Html::a(Html::img('@web/images/final.jpg'),'',['class'=>'col-md-8']);
           echo "<div class='pull-left'>".'<h1>मनरेगा शिकायत प्रबंधन</h1>'.'</div>'.'<div class="pull-right"><h4>'.'मनरेगा प्रकोष्ठ, ग्राम्य विकास विभाग, उत्तर प्रदेश'.'</h4></div>';
            NavBar::end();
      echo '<div class="menubar">';
            echo Nav::widget([
            
    'items' => [
         
              Yii::$app->user->isGuest ?'':
       ['label' => 'Work Demand', 'url' => ['/complaint/workdemand'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'create', 'url' => ['/complaint/workdemand/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'index', 'url' => ['/complaint/workdemand/index1'],'options'=>['class'=>'dropdown']],
            ['label' => 'report', 'url' => ['/complaint/report/dwise?t=workdemand'],'options'=>['class'=>'dropdown']],
      
      ]],
       ['label' => 'Job Card Demand', 'url' => ['/complaint/jobcarddemand'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'create', 'url' => ['/complaint/jobcarddemand/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'index', 'url' => ['/complaint/jobcarddemand/index1'],'options'=>['class'=>'dropdown']],
               ['label' => 'report', 'url' => ['/complaint/report/dwise?t=jobcarddemand'],'options'=>['class'=>'dropdown']],
      
      ]],
       ['label' => 'Complaints', 'url' => ['/complaint/complaint'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'create', 'url' => ['/complaint/complaint/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'index', 'url' => ['/complaint/complaint/index1'],'options'=>['class'=>'dropdown']],
               ['label' => 'report', 'url' => ['/complaint/report/dwise?t=complaint'],'options'=>['class'=>'dropdown']],
      
         !Yii::$app->user->can('complaintadmin') ?'':   
              ['label' => 'Complaint Type', 'url' => ['/complaint/complaint_type/create'],'options'=>['class'=>'dropdown']],
              ['label' => 'Complaint Type', 'url' => ['/complaint/complaint_subtype/create'],'options'=>['class'=>'dropdown']],
               ['label' => 'Hints', 'url' => ['/complaint/hint/hint?t=hints'],'options'=>['class'=>'dropdown']],
              ['label' => 'Labels', 'url' => ['/complaint/hint/hint?t=app'],'options'=>['class'=>'dropdown']],
             
            
                
            ]],
        Yii::$app->user->isGuest ?
        ['label' => 'Login', 'url' => ['/users/user/login?returnurl='.Url::to(['/complaint'])] ]:
        ['label' => \app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()?\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->name_en:'missing'.' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/users/user/logout'],
            'items'=>[
            ['label'=>'Change Password','url'=>['/users/user/changepassword']],
            ['label'=>'Logout','url'=>['/users/user/logout'],'linkOptions' => ['data-method' => 'post']],
            ]
            ],],'options'=>['class'=>'nav navbar-nav pull-right']
]);
echo '</div>';
?>
    <div class="row">
    <?php if (!Yii::$app->user->isGuest) {?>
    <div class="col-md-12 text-center">
     <?=\Yii::$app->getSession()->getFlash('message');?>

    </div>
      <div class="col-md-offest-1 col-md-3">
   
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
               
    <?php };
   require 'leftmenu.php';?>
    </div>
                    <div class="col-md-9">
        <?php } else { ?>
        <div class="col-md-12 small">
        <?php } ?>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">MNREGA Cell, Uttar Pradesh <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
