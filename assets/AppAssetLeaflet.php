<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetLeaflet extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        //'css/site.css',
        //'css/prettyPhoto.css',
        //'css/blue/style.css',
        //'css/jquery.dataTables.css',
        "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css",

    ];
    public $js = [
    'js/common.js',
   // 'https://www.google.com/jsapi',
      //  'js/googletransliterate.js',
       
        "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js",
        "http://maps.google.com/maps/api/js?v=3&sensor=false",
        'js/Google.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\jui\juiAsset',
    ];
}
