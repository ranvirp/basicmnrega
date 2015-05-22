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
   .navbar-nav > li > a {padding-top:10px !important; padding-bottom:10px !important;}
.navbar {min-height:40px !important}
    .navbar-green
    {
     background-color:#faf3e3
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
            echo '<div class="col-md-2">&nbsp;</div>';
            echo Html::a(Html::img('@web/images/final.jpg'),'',['class'=>'col-md-8']);
            NavBar::end();
            NavBar::begin([
                //'brandLabel' => 'KESCO',
                //'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-green navbar-fixed',
                ],
            ]);
            echo Nav::widget([
            
    'items' => [
       ['label' => 'Android APK', 'url' => Yii::getAlias('@web').'/android/latest/GPSPhotoUploader.apk'],
        ['label' => 'Master Data', 'url' => ['/site/index'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'Level', 'url' => ['/users/level/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Department', 'url' => ['/users/department/create'],'options'=>['class'=>'dropdown']],
            
             ['label' => 'Designation', 'url' => ['/users/designation/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'DesignationType', 'url' => ['/users/designation-type/create'],'options'=>['class'=>'dropdown']],
              ['label' => 'Division', 'url' => ['/work/division/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Substation', 'url' => ['/work/substation/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Circle', 'url' => ['/work/circle/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Scheme', 'url' => ['/work/scheme/create'],'options'=>['class'=>'dropdown']],
            ['label' => 'MaterialType', 'url' => ['/work/material-type/create'],'options'=>['class'=>'dropdown']],
            
            
                
            ]],
        ['label' => 'Data Entry', 'url' => ['#'],'options'=>['class'=>'dropdown']
            ,'items'=>[ 
            
                ['label' => 'Work', 'url' => ['/work/work/create'],'options'=>['class'=>'dropdown']],
                ['label' => 'Work Progress', 'url' => ['/work/work/addwp'],'options'=>['class'=>'dropdown']],
                ['label' => 'Add Material Requirement', 'url' => ['/work/work/addmq'],'options'=>['class'=>'dropdown']]
            ],
    ],
                ['label' => 'Reports', 'url' => ['#'],'options'=>['class'=>'dropdown']
            ,'items'=>[ 
                ['label' => 'Mandays generated', 'url' => ['/mnrega/parameter/display?id=7'],'options'=>['class'=>'dropdown']],
                

            ],
    ],
        
        Yii::$app->user->isGuest ?
        ['label' => 'Login', 'url' => ['/users/user/login']] :
        ['label' => \app\modules\users\models\Designation::find()->where(['officer_userid'=>Yii::$app->user->id])->one()->name_en.' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/users/user/logout'],
            'items'=>[
            ['label'=>'Change Password','url'=>['/users/user/changepassword']],
            ['label'=>'Logout','url'=>['/users/user/logout'],'linkOptions' => ['data-method' => 'post']],
            ]
            ],],'options'=>['class'=>'nav navbar-nav pull-right']
]);

            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
