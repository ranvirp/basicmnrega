
<html>
<head>
	<title>Google // Leaflet</title>
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	<script src="http://maps.google.com/maps/api/js?v=3&sensor=false"></script>
	<script src="<?=Yii::getAlias('@web').'/js/Google.js'?>" ></script>
	
</head>
<body>
	<!-- define a DIV into which the map will appear. Make it take up the whole window -->
	<div style="width:100%; height:100%" id="map"></div>
<script type='text/javascript'>
var map = new L.Map('map', {center: new L.LatLng(53.9618, 58.4277), zoom: 13});
var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
var ggl = new L.Google();
var ggl2 = new L.Google('TERRAIN');
map.addLayer(ggl);
map.addControl(new L.Control.Layers( {'OSM':osm, 'Google':ggl, 'Google Terrain':ggl2}, {}));
var markers= new L.featureGroup();
function addLocation(gpslat,gpslong)
{

}
function clearMarkers()
{
}
function addMarkers(url)
{
}
</script>
 
</body>
</html>
