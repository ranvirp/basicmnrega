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
.navbar {min-height:30px !important;font-size:8px;}
    .navbar-green
    {
     background-color:#faf3e3
    }
    </style>
   
</head>
<body class="">

<?php $this->beginBody() ?>
<div class="wrap">
      <div class="form-title">
        <div class="form-title-span" style="text-align:center">
         <h1>मनरेगा शिकायत प्रबंधन</h1>
        </div>
    </div> 
    <?php
      echo '<div class="menubar">';
            echo Nav::widget([
            
    'items' => [
      
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
    <div class="col-md-3">
                <section class="panel">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                       <li  class="active"> <a href='#'><span class="badge pull-right">25</span>Inbox</a></li>
                        <li  class=""> <a href='#'><span class="badge pull-right">5</span>WorkDemand</a></li>
                       <li  class=""> <a href='#'><span class="badge pull-right">10</span>Jobcarddemand</a></li>
                       <li  class=""> <a href='#'><span class="badge pull-right">10</span>Other complaints</a></li>
                       
                    </ul>
                </div>
            </section>
            </div>
        <div class="col-md-9 small">
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
