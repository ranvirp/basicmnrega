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


AppAsset_1::register($this);
app\assets\AppAssetGoogle::register($this);

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
  
    <script>
    var google_control;

    </script>
    </head>
<body class="">
<style>
.main-nav
{
 list-style:outside none none;
}
</style>
<ul class="main-nav">
 <li class="nav1">
   <a href="#">
   <div class="nav1-div">
   <span class="glyphicon glyphicon-file"> &nbsp; &nbsp;File</span>
     </div>
 
   </a>
 </li>
 <li class="nav1">
   <a href="#">
   <div class="nav1-div">
   <span class="glyphicon glyphicon-link"> &nbsp; &nbsp;Links</span>
     </div>
 
   </a>
 </li>
</ul>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>