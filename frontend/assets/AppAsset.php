<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/animate.min.css',
        'css/font-awesome.min.css',
        'css/owl.carousel.css',
        'css/owl.transitions.css',
        'http://fonts.googleapis.com/css?family=Roboto:300,400,500,700',
        'css/rateit.css',
        'css/lightbox.css',
        'css/bootstrap-select.min.css',
        'css/config.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/bootstrap-hover-dropdown.min.js',
        'js/owl.carousel.min.js',
        'js/echo.min.js',
        'js/jquery.easing-1.3.min.js',
        'js/bootstrap-slider.min.js',
        'js/jquery.rateit.min.js',
        'js/lightbox.min.js',
        'js/bootstrap-select.min.js',
        'js/wow.min.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
