<?php
use app\models\Property;
use app\models\PropertyType;
use app\assets\HomeAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\web\AssetBundle;

/* @var $this yii\web\View */
$this->title = Yii::$app->name . ' Home';

/* @var $this yii\web\View */
/* @var $property app\models\Property */

HomeAsset::register($this);

?>

<div id="map-canvas"></div>

<div>
    <div class="container">
        <div class="row" style="margin:35px 0px">
            <div class="col-xs-12">
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
    </div><!-- container -->
</div>

<div style="background-color:#eeeeee">
    <div class="container" style="padding-top:25px">
        <div class="row">
            <div class="col-xs-12" style="margin-top:25px">
                <div class="row">
                    <?php
                        $properties = Property::getRandomProperties(6);
                        foreach($properties as $property):
                    ?>
                    <div class="col-sm-4" style="margin-bottom:20px;">
                        <div style="
                            background:url(<?=$property->firstPhotoUrl()?>);
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
                            <?php
                                if(strlen($property->descr) > 50)
                                    echo substr($property->descr, 0, 50) . 
                                        Html::a(' more..', ['property/detail', 'id'=>$property->propId]);
                                else
                                    echo $property->descr;
                            ?>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>

