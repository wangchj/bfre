<?php

namespace app\assets;

use yii\web\AssetBundle;

class AddPropertyAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/views/property';
    public $css =
    [
        'form.css'
    ];
    public $js =
    [
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8Ls8RLsCalFAdQ48dPFQL-dEsgs0mF_E&libraries=geometry&sensor=false',
        'map_helper.js',
        'form.js',
        'form_photo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\InputmaskAsset'
    ];
}
