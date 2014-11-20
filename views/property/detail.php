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

    <div style="font-size:18px"><?= Html::encode($this->title) ?></div>
    <div class="property_state">
        <?php if($property->address != null):?><?=$property->address?>,<?php endif;?>
        <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
        <?=$property->county?>, <?=$property->state?>
    </div>

    <div style="margin-top:20px;float:left/*border:1px solid black;*/">
        <img src="<?=getFirstPhotoUrl($property)?>" style="width:450px;float:left;margin-right:20px"/>
        <table class="table table-striped" style="float:left;width:400px">
        <?php if($property->address!=null):?><tr><th>Street Address</th><td><?=$property->address?></td></tr><?php endif;?>
        <tr><th>City</th><td><?=$property->city?></td></tr>
        <tr><th>County</th><td><?=$property->county?></td></tr>
        <tr><th>State</th><td><?=$property->state?></td></tr>
        <tr><th>Size</th><td><?=$property->acres?> acres</td></tr>
        <tr><th>Price</th><td>$<?=number_format($property->price)?></td></tr>
        </table>
    </div>

    <div style="margin-top:20px;float:left">
    <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Description</div>
        <?=nl2br($property->descr)?>
    </div>

    <div style="margin-top:20px;float:left;width:100%">
    <div style="border-bottom:1px dotted #AAA; margin-bottom:10px;font-size:16px">Location</div>
        <div id="map" style="width:100%;height:500px"></div>
    </div>


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
?>