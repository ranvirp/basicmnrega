<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\gpsphoto\widgets;
use Yii;
/**
 * Description of PhotoWidget
 *
 * @author mac
 */
class GalleryWidget  extends \yii\base\Widget{
	//put your code here
	public $photos;
	public function run() {
		parent::run();
		$lang=Yii::$app->language;
		$items=[];
		if (!$this->photos)
		{
			echo '<b>Photo List Empty! </b>';
		}
		$photo=$this->photos[0];
			$items[]=['url'=>$photo->url,'src'=>$photo->url,'options'=>['title'=>$photo->title,'gpslat'=>$photo->gpslat,'gpslong'=>$photo->gpslong]];
		
		echo '<style> a.gallery-item>img{
		border: 1px solid grey;
    display: block;
    float: left;
    height: 75px;
    width:75px;}</style>';
    date_default_timezone_set('Asia/Kolkata');
		echo '<div id="ho">';
		foreach ($this->photos as $photo)
		{
		echo '<a class="gallery-item" photo-id="'.$photo->bwid.'" href="'.$photo->url.'" gpslat="'.$photo->gpslat.'" gpslong="'.$photo->gpslong.'" title="'.$photo->title.'" datetime="'.date('d/m/Y H:i:s',$photo->created_at).'">';
		if ($photo->thumbnail)
		echo '<img id="'.$photo->id.'" src="data:image/x-icon;base64,'.$photo->thumbnail.'">';
		else 
		echo '<img src="'.$photo->url."'>";
		echo '</a>';
		}
		echo "</div>";
		
		echo \dosamigos\gallery\Gallery::widget([
    'items' => $items,
			'options'=>['id'=>'ho'],
    'clientEvents' => [
        'onslide' => 'function(index, slide) {
            
	  var gpslat=$("#ho").find("a").eq(index).attr("gpslat");
	  var gpslong=$("#ho").find("a").eq(index).attr("gpslong");
	  marker =new L.marker([gpslat,gpslong]);
	  map.addLayer(marker);
      map.panTo(new L.latLng(gpslat,gpslong));     
        }'
]]);
	
	}
}
