<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-fileinput
 * @version 1.0.3
 */

namespace app\assets;
use Yii;
/**
 * Asset bundle for FileInput Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class KartikFileInputAsset extends \yii\web\AssetBundle
{
  public  $js=[];
  public $css=[];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
  
    public function init()
    {
       // $this->setSourcePath('@vendor/kartik-v/bootstrap-fileinput');
        //$this->setupAssets('css', ['css/fileinput']);
        //$this->setupAssets('js', ['js/fileinput']);
        $this->js=[Yii::getAlias('@vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js')];
        $this->css=[Yii::getAlias('@vendor/kartik-v/bootstrap-fileinput/css/fileinput.css')];
        parent::init();
       
    }
}