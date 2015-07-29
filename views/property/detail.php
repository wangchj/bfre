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

<div style="background:#191919">
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

<div class="container" style="padding-top:0px">

    <!-- div style="font-size:18px"><?= Html::encode($this->title) ?></div>
    <div class="property_state" style="margin-bottom:20px">
        <?php if($property->address != null):?><?=$property->address?>,<?php endif;?>
        <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
        <?=$property->county?>, <?=$property->state?>
    </div-->

    <h1><?=$property->headline?></h1>

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