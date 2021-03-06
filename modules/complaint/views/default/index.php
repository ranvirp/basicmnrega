<style>
.tile.tile-medium {
    height: 150px;
    width: 150px;
    margin-top:50px;
    margin-left:30px;
    }
.tile.tile-teal {
    background-color: #00aba9;
}
.tile {
    background-color: #2e8bcc;
    border: 4px solid #fff;
    color: #fff;
    cursor: pointer;
    display: block;
    float: left;
    min-height: 75px;
    min-width: 75px;
    opacity: 0.75;
    text-align: center;
    z-index: 1;
}
.tile h1, .tile h2, .tile h3, .tile h4, .tile h5, .tile h6 {
    color: #fff;
}
h1, .h1 {
    font-size: 36px;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    color: inherit;
    font-family: "Segoe UI Light","Helvetica Neue","Segoe UI","Segoe WP",sans-serif;
    font-weight: 100;
    line-height: 1.1;
}
.centered
{
margin-left:150px;
}
.no-padding
{
  padding:0px;
}
.title
{
  background:#a40;
  padding:10px;
  color:white;
  text-align: center;
}
</style>
<div class="col-md-8 no-padding">
  <div class="title">
 <h1>मनरेगा शिकायत प्रबंधन</h1>
</div>
</div>
<div class="col-md-8 well">

<h3>कॉल करें या फिर नीचे क्लिक करें :</h3>
<span class="glyphicons glyphicons-earphone"></span><h3><strong>24X7 Helpline No:</strong>18001805999,05224055999</h3>
</div>
<div clas="row">

<div class="col-md-8 bordered-form">
<div class="row">
   <div class="tile tile-medium col-sm-3">
       <a href="<?=\yii\helpers\Url::to(['/complaint/workdemand/create'])?>">
       <h3>काम की मांग दर्ज करने के लिए क्लिक करें </h3>
       </a>
   </div>
   <div class="tile tile-medium col-sm-3">
      <a href="<?=\yii\helpers\Url::to(['/complaint/jobcarddemand/create'])?>">
      <h3>जॉबकार्ड की मांग दर्ज करने के लिए क्लिक करें </h3>
       </a>
    </div>
    <div class="tile tile-medium col-sm-3">
       <a href="<?=\yii\helpers\Url::to(['/complaint/complaint/create'])?>">
       <h3>अन्य शिकायत दर्ज करने के लिए क्लिक करें ं</h3>
        </a>
      </div>
  </div>
    <div class="row">
    <?php
   $searchform=new \app\modules\complaint\models\SearchForm;
   echo $this->render('search',['model'=>$searchform]);
    
    ?>
    </div>

    

</div>
<?php if (Yii::$app->user->isGuest){?>
<div class="col-md-offset-1 col-md-3 bordered-form">
   <?php
  
   echo $this->render('../../../../modules/users/views/user/login',['model'=>new \app\modules\users\models\LoginForm]);
    
    ?>
  </div>
  <?php } ?>
</div>

