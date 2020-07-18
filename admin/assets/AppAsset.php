<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'asset/css/font-awesome.min.css',
        'asset/css/custom.css',
        'asset/css/responsive-custom.css',     
        'asset/css/datepicker.min.css',
        'asset/css//sweetalert.min.css',
        'asset/css//toastr.min.css',
        'css/custom_admin.css',
    ];
    public $js = [
        'asset/js/bootstrap.min.js',
        'asset/js/jquery.validate.min.js',
        'asset/js/sweetalert.min.js',
        'asset/js/toastr.min.js',
        'asset/js/left_sidebar.js',
        'asset/js/datepicker.min.js',
        'asset/js/jquery.canvasjs.min.js',
        'asset/js/grids.js',
        'js/experiences.js',
        'js/order.js',
        'js/contact_enquiries.js',
        'asset/js/custom.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
