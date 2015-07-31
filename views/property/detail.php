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

<div class="container" style="padding-top:0px">
    <div class="row">
        <div class="col-xs-12">
            <h1><?=$property->headline?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12" style="margin-top:10px">
            <table class="table">
                <?php if($property->address!=null):?>
                    <tr>
                        <td class="l">Address</td>
                        <td><?=$property->address?></td>
                        <td class="l">City</td>
                        <td><?=$property->city?></td>
                    </tr>
                <?php endif;?>
                
                <tr>
                    <td class="l">County</td>
                    <td><?=$property->county?></td>
                    <td class="l">State</td>
                    <td><?=UsStates::cton($property->state)?></td>
                </tr>

                <tr>
                    <td class="l">Type</td>
                    <td>
                        <?=$property->getTypeStr()?>
                    </td>
                    <td class="l">Acreage</td>
                    <td><?=$property->acres?> acres</td>
                </tr>
                
                <?php if($property->priceAcre || $property->priceTotal):?>
                    <tr>
                        <?php if($property->priceAcre):?>
                            <td class="l">Price Per Acre</td>
                            <td>$<?=number_format($property->priceAcre)?></td>
                        <?php endif;?>
                        <?php if($property->priceTotal):?>
                            <td class="l">Total Price</td>
                            <td>$<?=number_format($property->priceTotal)?></td>
                        <?php endif;?>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </div>
</div>

<hr />

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 960px;
                height: 480px; background: #151515; overflow: hidden; margin:0 auto">

                <!-- Loading Screen -->
                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                        background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                    </div>
                    <div style="position: absolute; display: block; background: url(../images/jssor/loading.gif) no-repeat center center;
                        top: 0px; left: 0px;width: 100%;height:100%;">
                    </div>
                </div>

                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 240px; top: 0px; width: 720px; height: 480px; overflow: hidden;">
                    <?php $photos = $property->allPhotoUrl()?>
                    <?php foreach($photos as $photo):?>
                        <div>
                            <img u="image" src="<?=$photoManager->getUrl($photo)?>" />
                            <img u="thumb" src="<?=$photoManager->getUrl($photo)?>" />
                        </div>
                    <?php endforeach?>
                </div>

                 <!-- Arrow Left -->
                <span u="arrowleft" class="jssora05l" style="top: 158px; left: 248px;">
                </span>
                <!-- Arrow Right -->
                <span u="arrowright" class="jssora05r" style="top: 158px; right: 8px">
                </span>

                <!-- thumbnail navigator container -->
                <div u="thumbnavigator" class="jssort02" style="left: 0px; bottom: 0px;">
                    <!-- Thumbnail Item Skin Begin -->
                    <div u="slides" style="cursor: default;">
                        <div u="prototype" class="p">
                            <div class=w><div u="thumbnailtemplate" class="t"></div></div>
                            <div class=c></div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
                <!--#endregion Thumbnail Navigator Skin End -->

            </div>
        </div>
    </div>
</div>

<hr />

<div class="container">

    <div class="row"><div class="col-sm-12">
        <h2>Description</h2>
        <?=nl2br($property->descr)?>
    </div></div>

    <?php if($property->features != null):?>
    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <h2>Special Features</h2>
        <?=nl2br($property->features)?>
    </div></div>
    <?php endif;?>

    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <h2>Location</h2>
        <div id="map" style="width:100%;height:500px"></div>
    </div></div>


</div>

<script type="text/javascript">
var pointStr = '<?=$property->latlon?>';
var boundStr = '<?=$property->bound?>';
</script>