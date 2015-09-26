<style>
.tile.tile-medium {
    height: 150px;
    width: 150px;
   // margin-left:200px;
   // margin-top:50px;
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
.water-container>h3
{
 //background:url('<?=Yii::getAlias('@web').'/images/water.jpg'?>');
 background-size:100%;
 background-color:blue;
 margin:20px;
 padding:20px;
 color:white;
}
</style>
<div class="row">

<div class="col-md-12 text-center">
       

<div class="col-md-4"></div>
</div>
<div class="col-md-6">
<div class="simple-box" style="margin-top:10px;">
 <?=$this->render('@app/modules/documents/views/document/view',['model'=>\app\modules\documents\models\Document::findOne(2)])?>
</div>

</div>
<div class="col-md-6">
<div class="col-md-12">
<div class="tile tile-medium ">
<a href="<?=\yii\helpers\Url::to(['/gpsphoto/photo/index1'])?>">
<h1>Photo Gallery</h1>
</a>
</div>
<div class="tile tile-medium">
<a href="<?=\yii\helpers\Url::to(['/mnrega/pond/create'])?>">
<h1>Data Entry</h1>
</a>
</div>
<div class="tile tile-medium ">
<a href="<?=\yii\helpers\Url::to(['/mnrega/pond/index'])?>">
<h1>View data</h1>
</a>
</div>
</div>
<div class="simple-box" style="margin-top:10px;">
 <?=$this->render('@app/modules/mnrega/views/pond/summary')?>
</div>

</div>

</div>
