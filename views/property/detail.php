<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\PropertyDetailAsset;
use app\components\geonames\UsStates;
use app\components\Keywords;

/* @var $this yii\web\View */
/* @var $property app\models\Property */

PropertyDetailAsset::register($this);

$this->title = "$property->headline for sale in $property->city, $property->county County, " . UsStates::cton($property->state) . ' - Bill Fowler Real Estate';
$this->registerMetaTag(['name'=>'keywords', 'content'=>Keywords::forProp($property)]);

$photoManager = Yii::$app->photoManager;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1><?=$property->headline?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10">
            <?=$property->city?>, <?=$property->county?>, <?=UsStates::cton($property->state)?>
        </div>
        <div class="col-xs-2" style="text-align:right">
            <?=$property->acres?> acres
        </div>
        <div class="col-xs-8">
            <?=$property->getTypeStr()?>
        </div>
        
        <div class="col-xs-4" style="text-align:right">
            <?=$property->priceAcre ? '$' . number_format($property->priceAcre) . ' per acre' : '$' . number_format($property->priceTotal)?>
        </div>
    </div>

    <hr/>

    <div class="row">
        <?php foreach($property->allPhotoUrl() as $photo):?>
            <div class="col-xs-6 col-sm-3">
                <a class="fancybox" rel="group" href="<?=$photoManager->getUrl($photo)?>">
                    <div class="" style="
                        background-image: url(<?=$photoManager->getUrl($photo)?>);
                        background-size:cover;
                        background-position: center center;
                        background-repeat: no-repeat;
                        overflow: hidden;
                        padding-bottom:75%;
                        border:1px solid #aaa; margin-bottom:10px">
                    </div>
                </a>
            </div>
        <?php endforeach;?>
    </div>

    <hr/>

    <div class="row">
        <div class="col-sm-12">
            <?=nl2br($property->descr)?>
        </div>
    </div>

    <?php if($property->features != null):?>
        <hr/>
        <div class="row">
            <div class="col-sm-12">
                <h2>Special Features</h2>
                <?=nl2br($property->features)?>
            </div>
        </div>
    <?php endif;?>

    <hr/>

    <div class="row">
        <div class="col-sm-12">
            <h2>Location</h2>
            <div id="map" style="width:100%;height:500px"></div>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <tr>
                    <th>Street Address</th>
                    <td><?=$property->address?></td>
                </tr>
                <tr>
                    <th>City</th>
                    <td><?=$property->city?></td>
                </tr>
                <tr>
                    <th>County</th>
                    <td><?=$property->county?></td>
                </tr>
                <tr>
                    <th>State</th>
                    <td><?=UsStates::cton($property->state)?></td>
                </tr>
                <tr>
                    <th>Latitude and Longitude</th>
                    <td><?=$property->latlon?></td>
                </tr>
                <tr>
                    <th>Property Type</th>
                    <td><?=$property->getTypeStr()?></td>
                </tr>
                <tr>
                    <th>Acreages</th>
                    <td><?=$property->acres?></td>
                </tr>
                <?php if($property->priceAcre):?>
                    <tr>
                        <th>Price Per Acre</th>
                        <td><?=$property->priceAcre?></td>
                    </tr>
                <?php endif;?>
                <?php if($property->priceTotal):?>
                    <tr>
                        <th>Price Total</th>
                        <td><?=$property->priceTotal?></td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
var pointStr = '<?=$property->latlon?>';
var boundStr = '<?=$property->bound?>';
</script>