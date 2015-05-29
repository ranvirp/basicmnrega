<?php
/* @var $this yii\web\View */
$this->title = 'UP MNREGS';
?>
<script>
var markers;
</script>
<style>
#map{height:400px;}
</style>
<div class="site-index">
<div class="body-content">
<div class="row">
<div class="col-md-12">
<h2 class="well">Latest Photos</h2>
</div>
</div>
<div class="row">
<div class="col-md-8">
<div id="map">
 <?php
 // \app\modules\gpsphoto\widgets\LeafletWidget::widget(['gpslat'=>'26.846510800000000000','gpslong'=>'80.946683200000050000']);
 ?>
</div>
<script type='text/javascript'>
map = new L.Map('map', {center: new L.LatLng(53.9618, 58.4277), zoom: 13});
var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
var ggl = new L.Google();
var ggl2 = new L.Google('TERRAIN');
map.addLayer(ggl);
map.addControl(new L.Control.Layers( {'OSM':osm, 'Google':ggl, 'Google Terrain':ggl2}, {}));
markers=new L.featureGroup();
</script>
</div>

<div class="col-md-4">
     <?php
      $photos=\app\modules\gpsphoto\models\Photo::find()->orderBy('created_at desc')->limit(10)->all();
      echo \app\modules\gpsphoto\widgets\GalleryWidget::widget(['photos'=>$photos]);
     echo '<script>';
     echo '$(document).ready(function(){';
     foreach ($photos as $photo)
     {
     echo "markers.addLayer(new L.marker(['".$photo->gpslat."','".$photo->gpslong."'],{title:'".$photo->title."'}));";
     
     }
     echo 'markers.addTo(map);';
     echo "map.panTo(new L.latLng(['".$photo->gpslat."','".$photo->gpslong."']));";
     echo '$("a.gallery-item").hover(function(){
     var gpslat=$(this).attr("gpslat");
	  var gpslong=$(this).attr("gpslong");
	  map.panTo(new L.latLng([gpslat,gpslong]));
	  });';
	  echo '});';
     echo '</script>';
     ?>
</div>
    </div>
    </div>
    

    
</div>
