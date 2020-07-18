<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'asset/css/font-awesome.min.css',
        'asset/css//sweetalert.min.css',
        'asset/css//toastr.min.css',
        'asset/css/custom.css',
        'asset/css/responsive-custom.css'
    ];
    public $js = [
        'asset/js/bootstrap.min.js',
        'asset/js/owl.carousel.min.js',
        'asset/js/sweetalert.min.js',
        'asset/js/toastr.min.js',
        'asset/js/custom.js',
        'js/auth.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
