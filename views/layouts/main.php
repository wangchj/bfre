<?php
use yii\helpers\Html;
use Yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LayoutAsset;

/* @var $this \yii\web\View */
/* @var $content string */

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
<?php include_once("analyticstracking.php") ?>
<?php $this->beginBody() ?>
    <div class="wrap">
        <nav id="w0" class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/~wangchj/bfmock" style="font-family:'Times New Roman','Times'; color:#555555; font-weight:bold">
                            <div style="font-family:'Times New Roman','Times'; font-weight:bold; color:#555555">
                                <span style="font-size:32px">B</span><span style="font-size:28px">ILL</span>
                                <span style="font-size:32px">F</span><span style="font-size:28px">OWLER</span>
                                <br/>
                                <!-- span stlye="text-align:right">Real Estate</span -->
                            </div>
                            <hr style="margin:3px 5px;border-color:#ddd">
                            <div style="text-align:center">
                                <span style="font-size:25px">R</span><span style="font-size:23px">eal</span>
                                <span style="font-size:25px">E</span><span style="font-size:23px">state</span>
                            </div>
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
                </div>
            </div>
        </nav>
        
        <?= $content ?>
        
    </div>

    <footer class="footer" style="border:0px">
        <div class="container">
            <p class="pull-left">&copy; Bill Fowler Real Estate <?= date('Y') ?></p>
            <p class="pull-right">Designed by <a href="http://codenuggets.com" target="_blank">codenuggets.com</a></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
