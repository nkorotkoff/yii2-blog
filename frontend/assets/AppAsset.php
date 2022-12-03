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
        'vendors/fontawesome/css/all.min.css',
        "vendors/themify-icons/themify-icons.css",
        "vendors/linericon/style.css",
        "vendors/owl-carousel/owl.theme.default.min.css",
        "vendors/owl-carousel/owl.carousel.min.css",
        "css/style.css"
    ];
    public $js = [
        "vendors/bootstrap/bootstrap.bundle.min.js",
        "vendors/owl-carousel/owl.carousel.min.js",
        "js/jquery.ajaxchimp.min.js",
        "js/mail-script.js",
        "js/main.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
