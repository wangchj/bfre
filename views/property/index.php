<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\PropertyType;
use app\components\Keywords;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$params = Yii::$app->controller->actionParams;
$state = array_key_exists('state', $params) ? ucfirst($params['state']) : null;

$this->title = ($type ? "$type, land," : "Land") . ' and real estate properties for sale in ' .
    ($state ? $state : 'Alabama, Georgia, and Tennessee') . ' - Bill Fowler Real Estate';

$this->registerMetaTag(['name'=>'keywords', 'content'=>
    ($state ? Keywords::forState($state) : ($type ? Keywords::forType($type) : Keywords::forAllProps()))]);

$photoManager = Yii::$app->photoManager;

setlocale(LC_MONETARY, 'en_US');

?>

<!-- div style="
    /*background-color: #6f5499;*/
    background-color:#efefef;
    padding-top:30px;
    padding-bottom: 40px;
    margin-bottom:30px;
    border-bottom: 1px solid #ddd   ">
    <div class="container">
        <h1 style="text-shadow: 0px 1px 1px #444;">Land and Properties for Sale</h1>
    </div>
</div -->

<div class="container" style="padding-top:0px; margin-top:30px">

    <!-- h1><?= Html::encode($this->title) ?></h1 -->

    <div class="row">
        <div class="col-md-9">
            <!-- col-xs-12 allows left and right padding -->
            <div class="col-xs-12">
                <!-- h1 style="margin-bottom:30px">Properties for Sale</h1 -->

                <?php if(count($properties) == 0) echo 'No properties found. Please refine your search.'; ?>

                <?php foreach($properties as $property):?>

                    <div class="property_root" style="margin-bottom:30px;">
                        
                        <!-- Property Heading -->
                        <div class="row" style="background-color:#dfebf9; border-top:1px solid #82a7d8">
                            <div class="col-xs-12 property_headline">
                                <div class="row">
                                    <div class="col-xs-9">
                                        <h2><a href="<?=Url::to(['property/detail', 'id'=>$property->propId])?>" style="text-decoration:none"><?=$property->headline?></a></h2>
                                    </div>
                                    <div class="col-xs-3 pull-right" style="text-align:right; margin-top:20px">
                                        <?=number_format($property->acres)?> acres
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <!-- Property address, city, county, state -->
                                        <!--div class="property_state" style="margin-bottom:10px" -->
                                            <?php /*if($property->address != null):?><?=$property->address?>, <?php endif;*/?>
                                            <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
                                            <?=$property->county?>, <?=$property->state?>
                                        <!-- /div -->
                                    </div>
                                    <div class="col-xs-4" style="text-align:right">
                                        <?php if($property->priceAcre != null):?>
                                            $<?=number_format($property->priceAcre)?> per acre
                                        <?php else:?>
                                            $<?=number_format($property->priceTotal)?>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="background-color:#eff5fd">
                            <div class="col-sm-4" style="padding:0px; background-color:#eee">
                                <?php
                                    $photos = $property->allPhotoUrl();
                                ?>
                                <?php if($photos && $photos[0]):?>
                                    <div style="
                                        background:url(<?=$photoManager->getUrl($photos[0])?>);
                                        background-size:cover;
                                        background-position:center;
                                        position:relative;
                                        overflow:hidden;
                                        padding-bottom:75%" class="imgTile" data-url="<?=Url::to(['property/detail', 'id'=>$property->propId])?>">
                                    </div>
                                <?php endif;?>
                            </div>
                            <div class="col-sm-8" style="overflow:hidden">
                                <?php
                                    if(strlen($property->descr) > 400)
                                        echo substr($property->descr, 0, 400) . 
                                            Html::a(' more..', ['property/detail', 'id'=>$property->propId]);
                                    else
                                        echo $property->descr;
                                ?>
                            </div>
                        </div> 
                    </div>

                <?php endforeach;?>
            </div>
        </div>

        <div class="col-md-3 small">
            <?php
                $params = Yii::$app->controller->actionParams;
                $state = array_key_exists('state', $params) ? ucfirst($params['state']) : null;
            ?>

            <b>Properties by State</b>
            <ul style="list-style-type:none; padding-left:10px">
                <li><div class="<?=$state === 'Alabama' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/index', 'state'=>'Alabama'])?>">Alabama</a></li>
                <li><div class="<?=$state === 'Georgia' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/index', 'state'=>'Georgia'])?>">Georgia</a></li>
                <li><div class="<?=$state === 'Tennessee' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/index', 'state'=>'Tennessee'])?>">Tennessee</a></li>
            </ul>

            <b>Properties by Type</b>
            <ul style="list-style-type:none; padding-left:10px">
                <li><div class="<?=$type === 'Commercial' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Commercial'])?>">Commercial</a></li>
                <li><div class="<?=$type === 'Development' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Development'])?>">Development</a></li>
                <li><div class="<?=$type === 'Farming' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Farming'])?>">Farming</a></li>
                <li><div class="<?=$type === 'Hunting' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Hunting'])?>">Hunting</a></li>
                <li><div class="<?=$type === 'Income' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Income'])?>">Income</a></li>
                <li><div class="<?=$type === 'Industrial' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Industrial'])?>">Industrial</a></li>
                <li><div class="<?=$type === 'Timber' ? 'tri-active' : 'tri'?>"></div><a href="<?=Url::to(['property/type', 'typeName'=>'Timber'])?>">Timber</a></li>
            </ul>            
        </div>

    </div>
</div>