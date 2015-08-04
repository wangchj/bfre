<?php
use app\models\Property;
use app\models\PropertyType;
use app\assets\HomeAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;

/* @var $this yii\web\View */
/* @var $this yii\web\View */
/* @var $property app\models\Property */

$this->title = 'Land and real estate properties for sale in Alabama, Georgia, Tennessee, and Southeastern United States - BillFowlerRealEstate.com';
$this->registerMetaTag(['name'=>'keywords', 'content'=>'land for sale in Alabama, land for sale in Georgia, land for sale in Tennessee, land for sale in Southeastern United States, real estate for sale, commercial properties, development properties for sale, airport, farm land, hunting land, income properties, industrial properties, timber, timberland, investment properties, vineyards, agriculture, agricultural, county, golf course, golf, home, sell, grain, multipurpose building, subdivision, buyer, seller, 1031 Tax-Differed Exchanges, Alabama, Georgia, Tennessee, Montgomery Alabama']);

HomeAsset::register($this);
?>

<div style="height:300px; overflow:hidden">
    <!-- img style="width:100%; position:relative; top:-220px" src="http://www.jellystonemaryland.com/Websites/jsmd/images/MarylandVineyard.jpg" -->
    <img style="width:100%; position:relative; top:-290px; left:0px; min-width:1268px" src="http://billfowlerrealestate.com/photos/54d929b016cdf/106_2392.JPG">
</div>

<div>
    <div class="container">
        <div class="row" style="margin:35px 0px">
            <div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-0" style="text-align:center; margin-top:25px; margin-bottom:25px">
                <img class="img-circle img-thumbnail" style="width:100%; box-shadow:0px 0px 9px #bbb" src="<?=Yii::getAlias('@web/images/southeast.png')?>">
            </div>
            <div class="col-xs-12 col-md-8">
                <p>
                Bill Fowler Real Estate operates in the Southeastern United Sates and specializes in <i>Land</i>, <i>Commercial Properties</i>, and <i>1031 Tax-Differed Exchanges</i>. For almost five decades in business, our company has experienced the full spectrum of issues involved in every aspect of real estate transactions, some of which were extremely complicated.
                </p>
                <p>
                The services provided have ranged from the sale of a single property to complicated transactions involving the sale and exchange of multiple properties. Our company has been successful in transactions that involved numerous entities with diverse goals. Succeeding where other have been unable to craft a deal that satisfies everyone continues to be a hallmark of the company.
                </p>
                <p>
                We provide personal care with absolute integrity; and as such is the go-to organization for both sellers and buyers who look for professional high-energy and dedicated expertise that will result in a successful conclusion to their real estate desires or problems.
                </p>
            </div>
        </div><!-- row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="bs-callout bs-callout-info">
                    <h4>Looking for something special?</h4>
                    <p>Tell us what kind of property you are looking for by <a href="<?=Url::to(['site/contact'])?>">contacting us</a>, and we will employ a vast list of contacts and resources, obtained through decades in the business, to find what you desire.</p>
                </div>
            </div>
        </div>
    </div><!-- container -->
</div>

<hr/>

<div style="background-color:#ffffff">
    <div class="container" style="padding-top:25px">
        <div class="row">
            <div class="col-xs-12" style="margin-top:25px">
                <div class="row">
                    <?php
                        setlocale(LC_MONETARY, 'en_US');
                        $properties = Property::getRandomProperties(6);
                        foreach($properties as $property):
                    ?>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                        <div style="
                            background:url(<?=Yii::$app->photoManager->getUrl($property->firstPhotoUrl())?>);
                            background-size:cover;
                            background-position:center;
                            position:relative;
                            overflow:hidden;
                            padding-bottom:75%" class="imgTile" data-url="<?=Url::to(['property/detail', 'id'=>$property->propId])?>">
                            <!-- img src="<?=$property->firstPhotoUrl()?>" style="width:100%" / -->
                        </div>
                        <div style="clear:both; padding:10px; text-align:center">
                            <a href="<?=Url::to(['property/detail', 'id'=>$property->propId])?>"><?=substr($property->headline, 0, 30)?></a>
                            <br>
                            <span style="font-size:0.9em"><?=$property->city ? $property->city : $property->county?>, <?=$property->state?></span>
                            <br>
                            <span style="font-size:0.9em">
                                <?=$property->acres?> acres |
                                <?=$property->priceAcre ? '$' . number_format($property->priceAcre) . ' per acre' : '$' . number_format($property->priceTotal)?>
                            </span>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $props = Property::find()->all();
    $markers = [];
    foreach($props as $prop) {
        $markers[] = [
            'headline'=>$prop->headline,
            'city'=>$prop->city,
            'county'=>$prop->county,
            'state'=>$prop->state,
            'latlon'=>$prop->latlon,
            'acres'=>$prop->acres,
            'url'=>Url::to(['property/detail', 'id'=>$prop->propId])
        ];
    }
    $json = json_encode($markers);
?>

<script type="text/javascript">
    var markerPoints = <?=$json?>;
</script>