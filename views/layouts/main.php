<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAsset_1;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$this->registerJs("imageloader='".Yii::getAlias('@web').'/images/ajax-loader.gif'."';",\yii\web\View::POS_READY);


//AppAsset_1::register($this);
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
    <script>
    var google_control;

    </script>
    </head>
<body class="">
    <style>
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
     color:#c41200;
    }
    .nav >li >a, .nav>li>a:hover, .nav >li >a:focus
    {
      //background-color:#3c68b0;
    }
    .nav>li>a
    {
    color:white;
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
    .grad {
  background: -webkit-linear-gradient(rgba(244,196,48,1),white, green); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(rgba(244,196,48,1),white, green); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(rgba(244,196,48,1),white, green); /* For Firefox 3.6 to 15 */
  background: linear-gradient(rgba(244,196,48,1),white, green); /* Standard syntax */
} 
   .navbar-nav > li > a {padding-top:10px !important; padding-bottom:10px !important;color:white;}
     .navbar-nav > li > a {padding-top:10px !important; padding-bottom:10px !important;color:white;}
.navbar {min-height:30px !important;font-size:8px;}
 .nav >li > a:hover, .nav >li > a:focus , .nav .open>a,.nav .open>a:hover,.nav .open>a:focus
{
 background:blue;
}
.navbar {min-height:30px !important;font-size:8px;}
    .navbar-green
    {
     background-color:#faf3e3
    }
    </style>
   


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
           echo '<div class="logo-text"><h2>'.'मनरेगा प्रकोष्ठ, ग्राम्य विकास विभाग, उत्तर प्रदेश'.'</h2></div>';
           NavBar::end();
            /*
            NavBar::begin([
                //'brandLabel' => 'KESCO',
                //'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-green navbar-fixed',
                ],
            ]);
            */
            echo '<div class="menubar">';
            echo Nav::widget([
            
    'items' => [
      ['label'=>'Home','url'=>['/site/index']],
       ['label'=>'Complaint','url'=>['/complaint']],
        Yii::$app->user->isGuest ?'':
       
     
       
         ['label' => 'Android APK', 'url' => Yii::getAlias('@web').'/android.apk','linkOptions'=>['data-toggle'=>'tooltip','data-placement'=>"left" ,'title'=>file_get_contents(Yii::getAlias('@app').'/modules/gpsphoto/apkhelp.txt')]],
      !Yii::$app->user->can('webadmin') ?'':
       ['label'=>'Permissions','url'=>['/admin'],'linkOptions'=>[]

        ],
        !Yii::$app->user->can('webadmin') ?'':
       ['label' => 'Master Data', 'url' => ['/site/index'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'Level', 'url' => ['/users/level/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Department', 'url' => ['/users/department/create'],'options'=>['class'=>'dropdown']],
            
             ['label' => 'Designation', 'url' => ['/users/designation/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'DesignationType', 'url' => ['/users/designation-type/create'],'options'=>['class'=>'dropdown']],
               ['label' => 'Users', 'url' => ['/users/user'],'options'=>['class'=>'dropdown']],
            
              ['label' => 'District', 'url' => ['/mnrega/district/index'],'options'=>['class'=>'dropdown']],
             ['label' => 'Block', 'url' => ['/mnrega/block/index'],'options'=>['class'=>'dropdown']],
             ['label' => 'Panchayat', 'url' => ['/mnrega/panchayat/index'],'options'=>['class'=>'dropdown']],
            
            
                
            ]],
          ['label' => 'Ponds', 'url' => ['#'],'options'=>['class'=>'dropdown']
            ,'items'=>[ 
                ['label' => 'Data Entry', 'url' => ['/mnrega/pond/create'],'options'=>['class'=>'dropdown']],
                
['label' => 'View List', 'url' => ['/mnrega/pond/index'],'options'=>['class'=>'dropdown']],
['label' => 'View Entire List', 'url' => ['/mnrega/pond/index1'],'options'=>['class'=>'dropdown']],
               
            ],
    ],
                ['label' => 'Reports', 'url' => ['#'],'options'=>['class'=>'dropdown']
            ,'items'=>[ 
                ['label' => 'Mandays generated', 'url' => ['/mnrega/parameter/show?t=mandays'],'options'=>['class'=>'dropdown']],
                
['label' => 'Categories Wise Work Analysis', 'url' => ['/mnrega/parameter/displaywc?id=2'],'options'=>['class'=>'dropdown']],
 ['label' => 'Analysis of Employment Parameters', 'url' => ['/mnrega/parameter/show?t=empstatus'],'options'=>['class'=>'dropdown']],
   ['label' => 'Muster Roll Filled vs Issued', 'url' => ['/mnrega/parameter/show?t=musterroll'],'options'=>['class'=>'dropdown']],
             
            ],
    ],
        
        Yii::$app->user->isGuest ?
        ['label' => 'Login', 'url' => ['/users/user/login']] :
        ['label' => \app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->name_en.' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/users/user/logout'],
            'items'=>[
            ['label'=>'Change Password','url'=>['/users/user/changepassword']],
            ['label'=>'Reset Password','url'=>['/users/user/request-password-reset']],
            
            ['label'=>'Logout','url'=>['/users/user/logout'],'linkOptions' => ['data-method' => 'post']],
            ]
            ],],'options'=>['class'=>'nav navbar-nav pull-right']
]);
echo '</div>';
          //  NavBar::end();
        ?>
        
        <div id="main-container" class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <div class="row-fluid">
            <?= Yii::$app->session->getFlash('success')?>
            <?= Yii::$app->session->getFlash('error')?>
            </div>
            <?= $content ?>
        </div>
    
<div class="clearfix"></div>
    <div class="footer">
       <div>
            <p class="pull-left">MNREGA Cell, Uttar Pradesh <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
     </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>