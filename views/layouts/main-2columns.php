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
//app\assets\KartikFileInputAsset::register($this);

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
    .contentrow>ul
    {
    list-style:outside none none;
    }
    .contentrow h1
    {
    font-size: 16px;
    line-height: 1.5em;
    color:blue;
    }
    .block
    {
     border-radius:4px 4px 0 0;
     border-top:1px solid #ccccc7;
     min-height:120px;
     padding:0px;
     border-bottom:1px solid #ccccc6;
     margin-bottom:15px;
      }
    .block-title
    {
      background: #ea050b linear-gradient(#ff2000 2%, #ea050b 10%, #d40d04 100%) repeat scroll 0 0;
      padding:9px 3px 6px 10px;
      font-size:105%;
      font-weight:bold;
    }
     .block-title-span>span
     {
      color:white;
     }
    .leftblocks
    {
      padding:0px;
      width:16.6667%;
      background:#ccc;
      margin-left:-15px;
      margin-top:-30px;
      float:left;
      min-height:1000px;
    // background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
     //background-size: 100%;
   
   
    }
     .rightblocks
    {
      padding:0px;
      width:16.6667%;
      background:#ccc;
      margin-right:-15px;
      margin-top:-30px;
      float:left;
      min-height:1000px;
        background:url('<?=Yii::getAlias('@web').'/images/middle_s.gif'?>');
     background-size: 100%;
   
   
    }
    .block>ul
    {
      list-style: outside none;
    }
    .block>ul>li
    {
      display: block;
      margin-left: -10px;
      width:50%;
      overflow: wrap-text;
      padding: 10px;

    }
    .block>ul>li:hover
    {
      background:#ddc;
    }
    .centercontainer
    {
     width:83%;
     float:left;
     padding-left:25px;
     padding-top:0;
     max-width: 1200px;
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
     color:#c41200;
    }
    .document-form>ul>li>a
    {
     color:blue;
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
    .kruti
    {
     font-family:"Kruti Dev 010"!important;
     border:1px solid orange;
     
    }
    .kruti:after
    {
     content:'Kruti Dev';
    }
    .taxonomy-default-index>h2
    {
      font-size:20px;
    }
    </style>
   
<script>

 $(document).ready(function()
 {

 $('#hindiinput-type').change(function()
 {
  if ($(this).val()==='')
  {
  //$('input:text,textarea').removeClass('hindiinput');
  //  $('input:text,textarea').removeClass('kruti');
 //$('input:text,textarea').off('focus');
  //  $('input:text,textarea').off('focusout');
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
  //$('input:text,textarea').addClass('kruti');
  //$('input:text,textarea').removeClass('hindiinput');
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
 $('.input-type').remove();
 $('.kruti').after('<span class="input-type">Kruti Dev Text</span>');
 } else
 if ($(this).val()=='google')
 {
  //$('input:text,textarea').addClass('hindiinput');
 // $('input:text,textarea').removeClass('kruti');
 
  $('.kruti').addClass('hindiinput');
  
   $('.kruti').removeClass('kruti');
   $('.hindiinput').off('focus');
    $('.hindiinput').off('focusout');
   if (typeof google_control =='object' && !google_control.isTransliterationEnabled())
    google_control.toggleTransliteration();
   $('.hindiinput').focus(function(){hindiEnable($(this))});
    $('.input-type').remove();

   $('.hindiinput').after('<span class="input-type">Google Transliteration-Press Ctrl-g to toggle</span>');
 }
 
 });
$('#hindiinput-type').val('google');
$('#hindiinput-type').trigger('change');
 });
 
 </script>

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
          ?>
                       <div class="pull-right col-md-2">
    <div style="margin-top:-50px;color:white;">
 <?php   echo Html::label('Hindi Input Type:');echo Html::DropDownList('hindiinput-type',null,['kruti'=>'Kruti Dev 010','google'=>'Google Transliteration'],['prompt'=>'Select Hindi Input type','id'=>'hindiinput-type','style'=>'color:black']);?>
<div class="help-tip"> Ctrl-g to disable google transliteration </div>
 </div>
 </div>
          <?php
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
         'encodeLabels' => false,   
    'items' => [
      ['label'=>'Home','url'=>['/site/index']],
       ['label'=>'Complaint','url'=>['/complaint']],
     !Yii::$app->user->can('webadmin') ?'':
       ['label'=>'Permissions','url'=>['/admin'],'linkOptions'=>[]

        ],
             !Yii::$app->user->can('webadmin') ?'':
       ['label'=>'Login History'.'<img src="http://www.indiaculture.nic.in/sites/all/themes/moc/images/new-gif.gif">','url'=>['/users/login-history'],'linkOptions'=>[]

        ],
      
        !Yii::$app->user->can('webadmin') ?'':
       ['label' => 'Master Data', 'url' => ['/site/index'],'linkOptions'=>[],'options'=>['class'=>'dropdown']
            ,'items'=>[
             ['label' => 'Level', 'url' => ['/users/level/create'],'options'=>['class'=>'dropdown']],
             ['label' => 'Department', 'url' => ['/users/department/create'],'options'=>['class'=>'dropdown']],
            
             ['label' => 'Designation', 'url' => ['/users/designation/index'],'options'=>['class'=>'dropdown']],
             ['label' => 'DesignationType', 'url' => ['/users/designation-type/create'],'options'=>['class'=>'dropdown']],
               ['label' => 'Users', 'url' => ['/users/user'],'options'=>['class'=>'dropdown']],
            
              ['label' => 'District', 'url' => ['/mnrega/district/index'],'options'=>['class'=>'dropdown']],
             ['label' => 'Block', 'url' => ['/mnrega/block/index'],'options'=>['class'=>'dropdown']],
             ['label' => 'Panchayat', 'url' => ['/mnrega/panchayat/index'],'options'=>['class'=>'dropdown']],
            
            
                
            ]],
          ['label' => 'Ponds', 'url' => ['#'],'options'=>['class'=>'dropdown']
            ,'items'=>[ 
                 ['label' => 'Android APK', 'url' => Yii::getAlias('@web').'/android.apk','linkOptions'=>['data-toggle'=>'tooltip','data-placement'=>"left" ,'title'=>file_get_contents(Yii::getAlias('@app').'/modules/gpsphoto/apkhelp.txt')]],
    
                ['label' => 'Data Entry', 'url' => ['/mnrega/pond/create'],'options'=>['class'=>'dropdown']],
                
['label' => 'View List', 'url' => ['/mnrega/pond/index'],'options'=>['class'=>'dropdown']],
['label' => 'View Entire List', 'url' => ['/mnrega/pond/index2'],'options'=>['class'=>'dropdown']],
               
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
   
 <div class="row-fluid">
 <div class="leftblocks">
  <?php foreach (\app\modules\taxonomy\models\Vocabulary::find()->all() as $vocabmodel) { ?>
   <div class="block leftblock1">
    <div class="block-title">
    <div class="block-title-span">
        <span><?=$vocabmodel->vocabname?> </span>
    </div>
  </div>
  
    <?php
   
      echo '<ul>';
     foreach (\app\modules\taxonomy\models\Term::find()->where(['vocabcode'=>$vocabmodel->vocabcode])->all() as $term) {
       echo '<li>'.Html::a($term->termname,Url::to(['/taxonomy?t='.$term->termcode])).'</li>';
    }
     echo '</ul>';
    ?>
   

   </div>
   <?php } ?>
<?php if (Yii::$app->user->can('webadmin')) { ?>
<div class="block">
   <div class="block-title">
    <div class="block-title-span">
        <span>For Administrators Only</span>
      </div>
    </div>
   <ul>
     <li> <?=Html::a('Add Vocabulary', Url::to(['/taxonomy/vocabulary/create']))?></li>
       <li> <?=Html::a('Add Term', Url::to(['/taxonomy/term/create']))?></li>
         <li> <?=Html::a('Add Taggable', Url::to(['/taxonomy/taggable/create']))?></li>
   <li> <?=Html::a('Articles', Url::to(['/docs/document/create']))?></li>
 <li> <?=Html::a('Links', Url::to(['/docs/link/create']))?></li>
 <li> <?=Html::a('Document Types', Url::to(['/docs/document-type/create']))?></li>
 <li> <?=Html::a('Document Sub Types', Url::to(['/docs/document-subtype/create']))?></li>
 
 
  </ul>
  </div>
<?php } ?>
 </div>
 <div class="centercontainer">
<?php  if (array_key_exists('rows',$this->params)) foreach ($this->params['rows'] as $row) { ?>
 <div class="col-md-12 centerrows">
 <?=$row?>
 </div>
 <?php } ?>
 <?= $content ?>
 </div>
 </div>
            
        </div>
    
<div class="clearfix"></div>
    <div class="footer">
       <div>
            <p class="pull-left">MNREGA Cell, Uttar Pradesh <?= date('Y') ?></p>
         
     </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>