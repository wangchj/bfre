<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = Yii::$app->name . ' About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container" style="padding-top:0px">
    <div class="row">
    <div class="col-sm-5 col-sm-offset-2">
    <h2>About Us</h2>
    </div></div>

    <div class="row">
        <div class="col-sm-2">
            
        </div>
        <div class="col-sm-8">
            <img src="<?=Url::to('@web/images/Photo.jpg')?>" style="float:left;width:160px;margin:0px 25px 0px 0px;"/>
            For decades the professionals at BFRE have served a wide variety of clients including individuals, corporations, banks and attorneys with both personal care and absolute integrity. The application of high-energy and dedicated expertise, coupled with a professional attitude that is focused on service, has ensured our clients that, regardless of the complexity of the real estate issue or the difficulty in satisfying diverse goals, an optimum solution to their real estate problems will be efficiency concluded in a timely manner.
            </p>
        </div>
    </div>
</div>
