<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\modules\gpsphoto\models\Photo;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
    function actionThumbnail()
    {
      $photos=Photo::find()->all();
      foreach($photos as $photo)
      {
        if (!base64_decode($photo->thumbnail))
        {
           print "processing ".$photo->id;
           $photo->thumbnail=$this->Thumbnail($photo->url);
           $photo->save();
        }
      }
    
    }
    function Thumbnail($url,  $width = 75, $height = 75) {

 // download and create gd image
 $image = ImageCreateFromString(file_get_contents($url));

 // calculate resized ratio
 // Note: if $height is set to TRUE then we automatically calculate the height based on the ratio
 $height = $height === true ? (ImageSY($image) * $width / ImageSX($image)) : $height;

 // create image 
 $output = ImageCreateTrueColor($width, $height);
 ImageCopyResampled($output, $image, 0, 0, 0, 0, $width, $height, ImageSX($image), ImageSY($image));

 // save image
  ob_start (); 

  imagejpeg ($output);
  $image_data = ob_get_contents (); 

ob_end_clean (); 
 //ImageJPEG($output, $filename, 95); 

 // return resized image
 return base64_encode($image_data); // if you need to use it
}
}
