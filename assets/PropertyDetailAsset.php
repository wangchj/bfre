<?php

namespace app\assets;

use yii\web\AssetBundle;

class PropertyDetailAsset extends AssetBundle
{
    public $sourcePath = '@app/views/property';
    public $css =
    [
        //'detail.css'
    ];
    public $js =
    [
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8Ls8RLsCalFAdQ48dPFQL-dEsgs0mF_E&libraries=geometry&sensor=false',
        'map_helper.js',
        'detail.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
