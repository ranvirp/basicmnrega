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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/prettyPhoto.css',
        'css/blue/style.css',
        'css/jquery.dataTables.css',
        
    ];
    public $js = [
    'js/common.js',
   // 'https://www.google.com/jsapi',
      //  'js/googletransliterate.js',
        'js/jquery.prettyPhoto.js',
        'js/jquery.tablesorter.min.js',
        'js/jquery.dataTables.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\jui\juiAsset',
    ];
}
