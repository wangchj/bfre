<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PropertyDetailAsset extends AssetBundle
{
    public $sourcePath = '@app/views/property';
    public $css =
    [
        //'detail.css'
    ];
    public $js =
    [
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyCPBfmojGyNxx_egxYm1uNr_Lb7Vu5Yvgs&libraries=geometry&sensor=false',
        'map_helper.js',
        'detail.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
