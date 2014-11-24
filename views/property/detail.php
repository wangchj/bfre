<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\PropertyDetailAsset;

/* @var $this yii\web\View */
/* @var $property app\models\Property */

PropertyDetailAsset::register($this);

$this->title = $property->headline;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-view">

    <!-- div style="font-size:18px"><?= Html::encode($this->title) ?></div>
    <div class="property_state" style="margin-bottom:20px">
        <?php if($property->address != null):?><?=$property->address?>,<?php endif;?>
        <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
        <?=$property->county?>, <?=$property->state?>
    </div-->

    <div class="row">
        <div class="col-sm-5" style="margin-top:20px">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
                <ol class="carousel-indicators" style="bottom:0px;margin-bottom:5px;opacity:0.75">
                    <?php
                    $photoUrls = getAllPhotoUrl($property);
                    for($i = 0; $i < count($photoUrls); $i++):?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" <?php if($i == 0) echo 'class="active"'?>></li>
                    <?php endfor;?>
                </ol>
                
                <div class="carousel-inner" role="listbox">
                    <?php
                    $photoUrls = getAllPhotoUrl($property);
                    for($i = 0; $i < count($photoUrls); $i++):?>
                    <div class="item <?php if($i == 0) echo 'active'?>">
                        <img src="<?php echo $photoUrls[$i]?>" />
                    </div>
                    <?php endfor;?>
                </div>
            </div>
        </div>

        <div class="col-sm-7" style="margin-top:20px"><table class="table table-striped">
        <?php if($property->address!=null):?><tr><th>Street Address</th><td><?=$property->address?></td></tr><?php endif;?>
        <tr><th>City</th><td><?=$property->city?></td></tr>
        <tr><th>County</th><td><?=$property->county?></td></tr>
        <tr><th>State</th><td><?=$property->state?></td></tr>
        <tr><th>Size</th><td><?=$property->acres?> acres</td></tr>
        <tr><th>Price</th><td>$<?=number_format($property->price)?></td></tr>
        </table></div>
    </div>

    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Description</div>
        <?=nl2br($property->descr)?>
    </div></div>

    <?php if($property->features != null):?>
    <div class="row"><div class="col-sm-12" style="margin-top:20px">
        <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Special Features</div>
        <?=nl2br($property->descr)?>
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

<?php
function getFirstPhotoUrl($property)
{
    if($property == null || $property->pictures == null || $property->pictures == '')
        return null;
    $pos = strpos($property->pictures, "\n");
    return substr($property->pictures, 0, $pos);
}

/**
 * Gets all photo url as an array of string.
 */
function getAllPhotoUrl($property)
{
    if($property == null || $property->pictures == null || $property->pictures == '')
        return null;
    return explode("\n", $property->pictures);
}
?>