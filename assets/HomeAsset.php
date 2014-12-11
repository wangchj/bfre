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
class HomeAsset extends AssetBundle
{
    public $sourcePath = '@app/views/site';
    public $css =['index.css'];
    public $js =
    [
        'http://billfowlerrealestate.com/land_agent_web/js/modernizr.js',
        'http://billfowlerrealestate.com/land_agent_web/js/jquery.flexslider.js',
        'index.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
