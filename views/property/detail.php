<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\PropertyDetailAsset;

/* @var $this yii\web\View */
/* @var $property app\models\Property */

PropertyDetailAsset::register($this);

$this->title = Yii::$app->name . ' property';
$photoManager = Yii::$app->photoManager;
?>
<div class="container" style="padding-top:0px">

    <!-- div style="font-size:18px"><?= Html::encode($this->title) ?></div>
    <div class="property_state" style="margin-bottom:20px">
        <?php if($property->address != null):?><?=$property->address?>,<?php endif;?>
        <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
        <?=$property->county?>, <?=$property->state?>
    </div-->

<h2><?=$property->headline?></h2>

    <div class="row">
        <div class="col-sm-6" style="margin-top:20px">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000">
                <ol class="carousel-indicators" style="bottom:0px;margin-bottom:5px">
                    <?php
                    $photoUrls = $property->allPhotoUrl();
                    for($i = 0; $i < count($photoUrls); $i++):?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" <?php if($i == 0) echo 'class="active"'?>></li>
                    <?php endfor;?>
                </ol>
                
                <div class="carousel-inner" role="listbox">
                    <?php
                    $photoUrls = $property->allPhotoUrl();
                    for($i = 0; $i < count($photoUrls); $i++):?>
                    <div class="item <?php if($i == 0) echo 'active'?>">
                        <img src="<?=$photoManager->getUrl($photoUrls[$i])?>" />
                    </div>
                    <?php endfor;?>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top:20px"><table class="table">
        <?php if($property->address!=null):?><tr><th>Street Address</th><td><?=$property->address?></td></tr><?php endif;?>
        <tr><th>City</th><td><?=$property->city?></td></tr>
        <tr><th>County</th><td><?=$property->county?></td></tr>
        <tr><th>State</th><td><?=$property->state?></td></tr>
        <tr><th>Size</th><td><?=$property->acres?> acres</td></tr>
        
        <?php if($property->priceAcre != null):?>
        <tr><th>Price Per Acre</th><td>$<?=number_format($property->priceAcre)?></td></tr>
        <?php endif;?>

        <?php if($property->priceTotal != null):?>
        <tr><th>Total Price</th><td>$<?=number_format($property->priceTotal)?></td></tr>
        <?php endif;?>
        
        </table></div>
    </div>

    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Description</div>
        <?=nl2br($property->descr)?>
    </div></div>

    <?php if($property->features != null):?>
    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Special Features</div>
        <?=nl2br($property->features)?>
    </div></div>
    <?php endif;?>

    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Location</div>
        <div id="map" style="width:100%;height:500px"></div>
    </div></div>


</div>

<script type="text/javascript">
var pointStr = '<?=$property->latlon?>';
var boundStr = '<?=$property->bound?>';
</script>