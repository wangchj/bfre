<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\Url;
use werx\Url\Builder;

class PhotoManager extends Component
{
    private $builder = null;
    public $baseUrl = null;

    public function getUrl($path)
    {
        if(!Url::isRelative($path))
            return $path;

        if($this->builder == null)
            $this->builder = new Builder($this->baseUrl);

        return $this->builder->asset($path);
    }
}