<?php
/**
 * @link http://www.codenuggets.com/
 * @copyright Copyright (c) 2015 codenuggets.com
 * @license http://www.codenuggets.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Chih Jye Wang <cjw39@hotmail.com>
 */
class InputmaskAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery.inputmask';
    public $css =[];
    public $js = ['dist/jquery.inputmask.bundle.min.js'];
    public $depends = ['yii\web\JqueryAsset'];
}
