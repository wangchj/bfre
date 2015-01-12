<?php
use yii\helpers\Html;
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
        <?php
            NavBar::begin([
                'brandLabel' => '<span style="font-size:1.2em">B</span>ill <span style="font-size:1.2em">F</span>owler <span style="font-size:1.2em">R</span>eal <span style="font-size:1.2em">E</span>state',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-ana',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['site/index']],
                    ['label' => 'About', 'url' => ['site/about']],
                    ['label' => 'Properties', 'url' => ['property/index']],
                    ['label' => 'Contact', 'url' => ['site/contact']],
                    [
                        'label' => Yii::$app->user->isGuest ? '' : 'Logout (' . Yii::$app->user->identity->fname . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ],
            ]);
            NavBar::end();
        ?>

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
