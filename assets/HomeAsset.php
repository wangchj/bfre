<?php
namespace app\assets;

use yii\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $sourcePath = '@app/views/site';
    public $css =[
        'http://getbootstrap.com/assets/css/docs.min.css',
        'index.css'
    ];
    public $js =
    [
        'index.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
