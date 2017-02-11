<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/animate.css',
        'css/font-awesome.css',
        'css/site.css',
    ];
    public $js = [
        'js/main/jquery.metisMenu.js',
        'js/main/jquery.slimscroll.js',
        'js/main/inspinia.js',
        'js/main/pace.min.js',
        'js/chartJs/Chart.min.js',
        'js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
