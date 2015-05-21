<?php
use yii\helpers\Html;
use Yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\LayoutAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
LayoutAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <nav id="w0" class="navbar-ana navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?=Url::to(['site/index'])?>">
                        <img src="<?=Yii::getAlias('@web/images/heading-logo.png')?>" style="width:250px">
                    </a>
                </div>
                <div id="w0-collapse" class="collapse navbar-collapse">
                    
                    <ul id="w1" class="navbar-nav navbar-right nav">
                        <li class="active"><a href="<?=Url::to(['site/index'])?>">Home</a></li>
                        <li><a href="<?=Url::to(['site/about'])?>">About</a></li>
                        <li><a href="<?=Url::to(['property/index'])?>">Properties</a></li>
                        <li><a href="<?=Url::to(['site/contact'])?>">Contact</a></li>
                        <?php if(!Yii::$app->user->isGuest): ?>
                        <li><a href="<?=Url::to(['site/logout'])?>" data-method="post">Logout (<?=Yii::$app->user->identity->fname?>)</a></li> 
                        <?php endif;?>
                    </ul>

                     <div style="display:inline;float:right; position:relative; top:8px; right: 10px">
                        <div style="
                            background-color:#d3cfab;
                            padding: 5px 10px;
                            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.22);
                            border-radius: 6px;
                            color:#292821;
                            opacity:1;
                            font-weight:bold;
                            font-size:12px;
                            /*opacity:0.8;*/
                            text-shadow:1px 1px #ddd">
                            <span class="glyphicon glyphicon-earphone"></span> &nbsp; <?=Yii::$app->params['phone']?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        
        <?= $content ?>
        
    </div>

    <footer class="footer footer-ana" style="border:0px">
        <div class="container">
            <p class="pull-left">&copy; Bill Fowler Real Estate <?= date('Y') ?></p>
            <p class="pull-right">Designed by <a href="http://codenuggets.com" target="_blank">codenuggets.com</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
