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
</style>
<div clas="row">
<div class="col-md-1">
</div>
<div class="col-md-11">
<div class="row">
   <div class="tile tile-medium col-sm-3">
       <a href="<?=\yii\helpers\Url::to(['/complaint/workdemand/create'])?>">
       <h1>काम की मांग</h1>
       </a>
   </div>
   <div class="tile tile-medium col-sm-3">
      <a href="<?=\yii\helpers\Url::to(['/complaint/jobcarddemand/create'])?>">
      <h1>जॉबकार्ड की मांग</h1>
       </a>
    </div>
    <div class="tile tile-medium col-sm-3">
       <a href="<?=\yii\helpers\Url::to(['/complaint/complaint/create'])?>">
       <h1>अन्य शिकायत</h1>
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
</div>

