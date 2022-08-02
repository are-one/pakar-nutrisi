<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        // 'jquery-ui.min.css',
        'assets2/vendor/bootstrap/css/bootstrap.min.css',
        'assets2/vendor/icofont/icofont.min.css',
        'assets2/vendor/boxicons/css/boxicons.min.css',
        'assets2/vendor/animate.css/animate.min.css',
        'assets2/vendor/owl.carousel/assets/owl.carousel.min.css',
        'assets2/vendor/venobox/venobox.css',
        'assets2/vendor/aos/aos.css',
        'assets2/css/style.css',
    ];
    public $js = [
        // 'jquery-ui.min.js',
        // 'assets2/vendor/jquery/jquery.min.js',
        'assets2/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'assets2/vendor/jquery.easing/jquery.easing.min.js',
        'assets2/vendor/php-email-form/validate.js',
        'assets2/vendor/waypoints/jquery.waypoints.min.js',
        'assets2/vendor/counterup/counterup.min.js',
        'assets2/vendor/owl.carousel/owl.carousel.min.js',
        'assets2/vendor/venobox/venobox.min.js',
        'assets2/vendor/aos/aos.js',
        'assets2/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
