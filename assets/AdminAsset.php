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
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assetAdmin/css/bootstrap.min.css',
        'assetAdmin/css/bootstrap-responsive.min.css',
        'assetAdmin/css/colorpicker.css',
        'assetAdmin/css/datepicker.css',
        'assetAdmin/css/uniform.css',
        'assetAdmin/css/select2.css',
        'assetAdmin/css/matrix-style.css',
        'assetAdmin/css/matrix-media.css',
        'assetAdmin/css/bootstrap-wysihtml5.css',
        'assetAdmin/font-awesome/css/font-awesome.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800',
    ];
    public $js = [
        // 'assetAdmin/js/jquery.min.js',
        'assetAdmin/js/jquery.ui.custom.js',
        'assetAdmin/js/bootstrap.min.js',
        'assetAdmin/js/jquery.uniform.js',
        'assetAdmin/js/select2.min.js',
        'assetAdmin/js/jquery.dataTables.min.js',
        'assetAdmin/js/matrix.js',
        'assetAdmin/js/matrix.tables.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
