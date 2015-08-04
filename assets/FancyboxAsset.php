<?php
namespace app\assets;

use yii\web\AssetBundle;

class FancyboxAsset extends AssetBundle
{
    public $baseUrl = '@web/js/fancybox';
    public $css =
    [
        'source/jquery.fancybox.css?v=2.1.5'
    ];
    public $js = [
        'source/jquery.fancybox.pack.js?v=2.1.5'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
