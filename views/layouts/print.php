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
    th{text-align:center; }
    </style>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
     
    <?php $this->head() ?>
    
</head>
<body class="">

<?php $this->beginBody() ?>
<div class="wrap">
      
    
    <div class="row">
    
         
        <div class="col-md-12 small">
        
            <?= $content ?>
        </div>
    </div>
</div>
    

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
