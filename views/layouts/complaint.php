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
app\assets\AppAssetGoogle::register($this);
\yii\widgets\PjaxAsset::register($this);

$this->registerJs("imageloader='".Yii::getAlias('@web').'/images/ajax-loader.gif'."';",\yii\web\View::POS_READY);
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
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/js/krutiunicodekruti.js'?>"></script>
    <style>
    .menubar
    {
     margin-bottom:15px;
     margin-top:5px;
   //  border:solid 1px;
   //  background-color:#3c68b6;
     background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
     background-size: 100%;
     display:table;
     width:100%;
     color:#c41200;
    }
    .nav>li>a
    {
    color:grey;
    }
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
   .navbar-nav > li > a {padding-top:10px !important; padding-bottom:10px !important;color:red;}
.navbar {min-height:30px !important;font-size:8px;}
 .nav >li > a:hover, .nav >li > a:focus , .nav .open>a,.nav .open>a:hover,.nav .open>a:focus
{
 background:red;
 color:white;
}

 .menubar>ul>li > a , .menubar>.open>a
{
// background:#DC150C;
// background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
//background-size:100%;
 border-right:1px dotted;
 width:220px;
}
 .menubar>.user-name>li > a , .menubar>.open>a
{
// background:#FF0D59;
//background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
//background-size:100%;
 border-right:1px dotted;
 max-width:200px;
 color:white;
}
    .navbar-green
    {
     background-color:#faf3e3
    }
    .menubar1
    {
     margin-bottom:15px;
     margin-top:5px;
     border:solid 1px;
   //  background-color:#3c68b6;
     //background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
     background-size: 100%;
     display:table;
     width:100%;
    }
    .user-name
    {
     margin-top:-60px;
    }
    .kruti
    {
     font-family:"Kruti Dev 010"!important;
     border:1px solid orange;
     
    }
    .kruti:after
    {
     content:'Kruti Dev';
    }
    </style>
 <script>
 var google_control;

 $(document).ready(function()
 {
 $('#hindiinput-type').change(function()
 {
  if ($(this).val()==='')
  {
   $('#textbox').remove();
   $('.kruti').addClass('hindiinput');
   $('.kruti').removeClass('kruti');
    $('.hindiinput').off('focus');
    $('.hindiinput').off('focusout');
    $('.input-type').remove();
     if (typeof google_control =='object' && google_control.isTransliterationEnabled())
    google_control.toggleTransliteration();
  
  }
 else
 if ($(this).val()==='kruti')
 {
  $('#textbox').remove();
  /*
 $('#hindiinput-type').after('<div id="textbox"><p><textarea class="js-copytextarea kruti">Hello Im some text</textarea></p><p>\
 <p>Type in Kruti Dev, select and copy text in unicode and paste anywhere \
</p></div>');
 */

  $('.hindiinput').addClass('kruti');
  $('.hindiinput').removeClass('hindiinput');
  
  //console.log(google_control);
   if (typeof google_control =='object' && google_control.isTransliterationEnabled())
    google_control.toggleTransliteration();
  // console.log(google_control);
   $('.kruti').focus(function()
 {
   $(this).val(Convert_to_Kritidev_010($(this).val()));
   
 });
 $('.kruti').focusout(function()
 {
// alert($(this).val());
   $(this).val(convert_to_unicode($(this).val()));
  // alert($(this).val());
   
 });
  $('.kruti').select(function()
 {
// alert($(this).val());
   $(this).val(convert_to_unicode($(this).val()));
  // alert($(this).val());
   
 });
 $('.input-type').remove();
 $('.kruti').after('<span class="input-type">Kruti Dev Text</span>');
 } else
 if ($(this).val()=='google')
 {
 $('#textbox').remove();
/*
  $('#hindiinput-type').after('<div id="textbox"><p><textarea class="js-copytextarea kruti">Hello Im some text</textarea></p><p>\
 <p>Type in Roman and , select and copy text in unicode and paste anywhere \
</p></div>');
*/
  $('.kruti').addClass('hindiinput');
  
   $('.kruti').removeClass('kruti');
   $('.hindiinput').off('focus');
    $('.hindiinput').off('focusout');
   if (typeof google_control =='object' && !google_control.isTransliterationEnabled())
    google_control.toggleTransliteration();
   $('.hindiinput').focus(function(){hindiEnable($(this))});
    $('.input-type').remove();

   $('.hindiinput').after('<span class="input-type">Google Transliteration</span>');
 }
 
 });
 $('#hindiinput-type').val('kruti');
 $('#hindiinput-type').trigger('change');
 
 });
 
 </script>
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
                    'class' => 'navbar navbar-default no-margin main-header',
                ],
            ]);
           // echo Html::a(Html::img('@web/images/final.jpg'),'',['class'=>'col-md-8']);
           echo "<div class='pull-left logo-text'>".'<h1>मनरेगा शिकायत प्रबंधन</h1>'.'</div>'.'<div class="centered logo-text"><h2>'.'मनरेगा प्रकोष्ठ, ग्राम्य विकास विभाग, उत्तर प्रदेश'.'</h2>';
           ?>
           
       
         <?php 
          //  echo '<div class="pull-right">';
            echo '</div>';
            NavBar::end();
      echo '<div class="menubar hidden-print">';
            echo Nav::widget([
         // 'encodeLabels'=>false,
                  
    'items' => [
         ['label' => 'Home', 'url' => ['/complaint'],'linkOptions'=>[],'options'=>['class'=>'dropdown']],
              Yii::$app->user->isGuest ?'':
       ['label' => 'Work Demand',
        'encodeLabels'=>true,'url' => ['/complaint/workdemand'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'create', 'url' => ['/complaint/workdemand/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'index', 'url' => ['/complaint/workdemand/index'],'options'=>['class'=>'dropdown']],
            ['label' => 'report', 'url' => ['/complaint/report/dwise?t=workdemand'],'options'=>['class'=>'dropdown']],
      
      ]],
        Yii::$app->user->isGuest ?'':
       ['label' => 'Job Card Demand', 'url' => ['/complaint/jobcarddemand'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'create', 'url' => ['/complaint/jobcarddemand/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'index', 'url' => ['/complaint/jobcarddemand/index'],'options'=>['class'=>'dropdown']],
               ['label' => 'report', 'url' => ['/complaint/report/dwise?t=jobcarddemand'],'options'=>['class'=>'dropdown']],
      
      ]],
        Yii::$app->user->isGuest ?'':
       ['label' => 'Complaints', 'url' => ['/complaint/complaint'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'Create', 'url' => ['/complaint/complaint/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Index', 'url' => ['/complaint/complaint/index'],'options'=>['class'=>'dropdown']],
               ['label' => 'Report Source Wise District Wise', 'url' => ['/complaint/report/dwise1'],'options'=>['class'=>'dropdown']],
       ['label' => 'Report Source Wise', 'url' => ['/complaint/report/sourcewise'],'options'=>['class'=>'dropdown']],
      
         !Yii::$app->user->can('complaintadmin') ?'':   
              ['label' => 'Complaint Type', 'url' => ['/complaint/complaint_type/create'],'options'=>['class'=>'dropdown']],
          !Yii::$app->user->can('complaintadmin') ?'':   
         
          ['label' => 'Complaint Sub type', 'url' => ['/complaint/complaint_subtype/create'],'options'=>['class'=>'dropdown']],
             !Yii::$app->user->can('complaintadmin') ?'':   
         
             ['label' => 'Hints', 'url' => ['/complaint/hint/hint?t=hints'],'options'=>['class'=>'dropdown']],
            !Yii::$app->user->can('complaintadmin') ?'':   
         
            ['label' => 'Labels', 'url' => ['/complaint/hint/hint?t=app'],'options'=>['class'=>'dropdown']],
             
            
                
            ]],
     ],'options'=>['class'=>'nav navbar-nav centered']
]);
echo Nav::widget([
           'items'=>[Yii::$app->user->isGuest ?
        ['label' => 'Login', 'url' => ['/site/index?returnurl='.Url::to(['/complaint'])] ]:
        ['label' => \app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()?\app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->name_en:'missing'.' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/users/user/logout'],
            'items'=>[
            ['label'=>'Change Password','url'=>['/users/user/changepassword']],
            
            ['label'=>'Logout','url'=>['/users/user/logout'],'linkOptions' => ['data-method' => 'post']],
            ]
            ],],'options'=>['class'=>'user-name nav navbar-nav pull-right'],
            
            ]);
echo '</div>';
?>
<div class="row hidden-print">
  <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
</div>
<a class="hide" id="refreshlink"></a>

<?php
 //\yii\widgets\Pjax::begin(['id'=>"test-div",'enablePushState'=>false,'timeout'=>false]);
                   // \yii\widgets\Pjax::end();
                    ?>
    <div class="container" id="main-container">
    <div class="row">
    <?php if (!Yii::$app->user->isGuest) {?>
    <div class="col-md-12 text-center">
    <div class="small" style="top:150px;right:0px;background:orange;z-index:1000">
 <?php   echo Html::label('Hindi Input Type:');echo '<br>';echo Html::DropDownList('hindiinput-type',null,['kruti'=>'Kruti Dev 010','google'=>'Google Transliteration'],['prompt'=>'Select','class'=>'small','id'=>'hindiinput-type']);?>
<div class="help-tip small"> Ctrl-g to toggle google transliteration </div>
 </div>
 <?=\Yii::$app->getSession()->getFlash('message');?>

    </div>
      
   
  
   <?php   echo '<a class="hide" id="leftmenurefreshlink" href="'.Url::to(['/complaint/complaint/leftmenu']).'"></a>';?>
          
    <div class="col-md-offest-1 col-md-3 hidden-print" id="leftmenu">
    <?php
   // include 'unmarked.php';
   if (Yii::$app->user->can('complaintadmin') || Yii::$app->user->can('complaintagent'))
    {
    require "unmarked.php";
    require 'leftmenuadmin.php';
     //  echo '<a class="hide" id="maincontainerrefreshlink" href="'..'"></a>';

    }
    else
    {
    
   require 'leftmenu.php';
  // echo '<a class="hide" id="leftmenurefreshlink" href="'..'"></a>';
    
   }
   ?>
   </div>
    
                    <div class="col-md-8">
                    <div id="complaint-panel-div">
                    </div>
                    <?php 
                   
                    ?>
              <?php  }   else { ?>
        <div class="col-md-12 small">
        <?php } ?>
          
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
</div>
<div id="errorDiv"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>