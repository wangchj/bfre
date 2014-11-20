<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Properties';
$this->params['breadcrumbs'][] = $this->title;

setlocale(LC_MONETARY, 'en_US');

?>
<div class="property-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach($properties as $property):?>
        <div style="width:100%;border:1px solid #eee; clear:both; margin-bottom:20px">
            <img src="<?=getFirstPhotoUrl($property)?>" style="width:250px;float:left;margin:20px"/>
            <div style="margin:20px; margin-left:290px; border:2px solid $000">
                <div class="property_headline" style="font-size:18px">
                    <a href="<?=Url::to(['property/detail', 'id'=>$property->propId])?>"><?=$property->headline?></a>
                </div>
                <?php if($property->address != null):?><div><?=$property->address?></div><?php endif;?>
                <div class="property_state">
                    <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
                    <?=$property->county?>, <?=$property->state?>
                </div>
                
                <div class="property_desc" style="margin-top:10px;">
                    <?=$property->descr?>
                </div>

                <div style="margin-top:10px"><?=number_format($property->acres,2)?> acres | $<?=number_format($property->price)?></div>
            </div>
        </div>
    <?php endforeach;?>

</div>

<?php
function getFirstPhotoUrl($property)
{
    if($property == null || $property->pictures == null || $property->pictures == '')
        return null;
    $pos = strpos($property->pictures, "\n");
    return substr($property->pictures, 0, $pos);
}
?>