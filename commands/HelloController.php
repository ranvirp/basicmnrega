<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\modules\gpsphoto\models\Photo;
use yii\db\Migration;
use Yii;

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
public function actionLoadMarking()
{
 $complaints=\app\modules\complaint\models\Complaint::find()->where('id<1000')->all();
 $i=1;
  foreach ($complaints as $complaint)
  {
   if ($i==1) {$maintype='po';$actiontype='a';}
   if ($i==2) {$maintype='cdo';$actiontype='a';}
   if ($i==3) {$maintype='sqm';$actiontype='e';}
   $complaint->_createSingleMarking1($actiontype,0,0,$maintype);
   $complaint->save();
    if ($i==3) $i=1; else $i++;
  
  }

}
public function actionLoadOnce()
{
  $rows=require Yii::getAlias('@app').'/tests/unit/fixtures/data/complaint.php';
  $migrate=new Migration;
  $insertrows=[];
  $columns=[];
  $row=$rows[0];
  $columns=array_keys($row);
  foreach ($rows as $row)
  {
    
    $insertrows[]=array_values($row);
    }
  
 // print_r($insertrows);
  //print_r($columns);
  
  $migrate->batchInsert('{{%complaint}}',$columns,$insertrows);
}

public function actionCad($designationtype)//Create All Designations
{
  $dt=\app\modules\users\models\DesignationType::find()->where(['shortcode'=>$designationtype])->one();
  $levelclass=$dt->level->class_name;
  $levels=\yii\helpers\ArrayHelper::map($levelclass::find()->asArray()->all(),'code','name_en');
  foreach ($levels as $code=>$name)
  {
   $designation=\app\modules\users\models\Designation::find()->where(['designation_type_id'=>$dt->id,'level_id'=>$code])->one();
   if (!$designation)
   $designation=new \app\modules\users\models\Designation;
   $designation->designation_type_id=$dt->id;
   $designation->level_id=$code;
   $designation->name_en=$dt->name_en.",".$name;
    $designation->name_hi=$dt->name_hi.",".$name;
  print "creating ".$dt->name_en.",".$name."\n"; 
   $designation->createUserAndRole();
  }

}
 /* this command gets access_token of user
 */
 public function actionToken($username)
 {
  $user = \app\modules\users\models\User::find()->where(['username'=>$username])->one();
  print $user->auth_key;
 
 }
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
     public function actionJson()
     
    {
      $districts=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\District::find()->orderBy('name_en asc')->asArray()->all(),'code','name_en');
      file_put_contents('/Users/mac/htdocs/basicmnrega/web/jsons/district.json',json_encode($districts));
      
      foreach ($districts as $code=>$name)
      {
      $blocks=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->where(['district_code'=>$code])->orderBy('name_en asc')->asArray()->all(),'code','name_en');
       file_put_contents('/Users/mac/htdocs/basicmnrega/web/jsons/'.$code.'.json',json_encode($blocks));
     
      
    }
     
     }
     public function actionSingle()
     {
      $x=[];
      $districts=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\District::find()->orderBy('name_en asc')->asArray()->all(),'code','name_en');
      $x['district']=$districts;
      //file_put_contents('/Users/mac/jsons/district.json',json_encode($districts));
      
      foreach ($districts as $code=>$name)
      {
      $blocks=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->where(['district_code'=>$code])->orderBy('name_en asc')->asArray()->all(),'code','name_en');
      $x['blocks'][$code]=$blocks;
      }
     file_put_contents('/Users/mac/jsons/single.json',json_encode($x));
     
     }
     public function actionPanchayat()
     {
      $x=[];
      $blocks=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->orderBy('name_en asc')->asArray()->all(),'code','name_en');
      //file_put_contents('/Users/mac/jsons/district.json',json_encode($districts));
      
      foreach ($blocks as $code=>$name)
      {
      $panchayats=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Panchayat::find()->where(['block_code'=>$code])->orderBy('name_en asc')->asArray()->all(),'code','name_en');
      $x=$panchayats;
      file_put_contents('/Users/mac/jsons/'.$code.'.json',json_encode($x));
      }
     
     
     }
     public function actionBlock()
     {
      $blocks=\yii\helpers\ArrayHelper::map(\app\modules\mnrega\models\Block::find()->orderBy('name_en asc')->asArray()->all(),'code','name_en');
      //file_put_contents('/Users/mac/jsons/district.json',json_encode($districts));
      
      file_put_contents('/Users/mac/htdocs/basicmnrega/web/jsons/'.'block'.'.json',json_encode($blocks));
      
     
     
     }
     
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
    function actionThumbnail()
    {
      $photos=Photo::find()->all();
      foreach($photos as $photo)
      {
        //if (!base64_decode($photo->thumbnail))
        //{
           print "processing ".$photo->id;
           $photo->thumbnail=$this->Thumbnail($photo->url);
           $photo->save();
        //}
      }
    
    }
    function Thumbnail($url,  $width = 75, $height = 75) {

 // download and create gd image
 $image = @ImageCreateFromString(file_get_contents($url));
if ($image)
{
 // calculate resized ratio
 // Note: if $height is set to TRUE then we automatically calculate the height based on the ratio
 $height = $height === true ? (ImageSY($image) * $width / ImageSX($image)) : $height;

 // create image 
 $output = ImageCreateTrueColor($width, $height);
 ImageCopyResampled($output, $image, 0, 0, 0, 0, $width, $height, ImageSX($image), ImageSY($image));
}else
{
$output = ImageCreateTrueColor($width, $height);
}
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
