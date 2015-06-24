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
class PhotoWidget  extends \yii\base\Widget{
	//put your code here
	public $photos;
	public function run() {
		parent::run();
		$model=$this->model;
		$lang=Yii::$app->language;
		$items=[];
		if (!$this->photos)
		{
			echo '<b>Photo List Empty! </b>';
		}
		foreach ($this->photos as $photo)
		{
		   
			$items[]=['url'=>$photo->url,'src'=>$photo->url,'options'=>['title'=>$photo->title,'gpslat'=>$photo->gpslat,'gpslong'=>$photo->gpslong]];
		}
		
		echo \dosamigos\gallery\Carousel::widget([
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
