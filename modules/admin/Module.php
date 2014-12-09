<?php

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();

        $this->layoutPath = __DIR__ . '/views/layouts';
        $this->layout = 'main.php';
        $this->defaultRoute = 'property';
    }
}
