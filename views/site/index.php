<?php
use app\models\Property;
use app\models\PropertyType;
use app\assets\HomeAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->title = Yii::$app->name . ' Home';

/* @var $this yii\web\View */
/* @var $property app\models\Property */

HomeAsset::register($this);
?>

<!-- link href="http://billfowlerrealestate.com/land_agent_web/css/style.css" rel="stylesheet" type="text/css" media="all" / -->
<!-- link href='http://fonts.googleapis.com/css?family=Baumans' rel='stylesheet' type='text/css' -->


<div style="width:100%;
    /*height:400px;*/
    /*margin-top:70px;*/
    padding:20px 0px;
    background-color:#565249;">

    <div class="container">
        <div class="row">
            <!-- div class="col-sm-3" style="margin-top:25px">
                
            </div -->
            
            <div class="col-sm-12" style="color: rgb(214, 213, 186);">
                
                <img src="<?=Url::to('@web/images/us.png')?>" align="left" style="margin:25px 30px 10px 10px"/>
                <h2>Welcome</h2>
                
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


<div class="container" style="padding-top:25px">
    <div class="row">

        <div class="col-sm-9" style="margin-top:25px">
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
                        <a href="<?=Url::to(['property/detail', 'id'=>$property->propId])?>"><?=$property->headline?></a>
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

        <div class="col-sm-3">

        <h3>Search</h3>

        <form action="<?=Url::to(['property/index'])?>">

            <label class="label-light" for="property-acres">Acres</label>
            <div class="row" style="margin-bottom:10px">
                <div class="col-sm-6"><input type="text" name="minAcres" class="form-control control-light" placeholder="Min acres"></div>
                <div class="col-sm-6"><input type="text" name="maxAcres" class="form-control control-light" placeholder="Max acres"></div>
            </div>

            <label class="label-light" for="property-acres">Price</label>
            <div class="row" style="margin-bottom:10px">
                <div class="col-sm-6"><input type="text" name="minPrice" class="form-control control-light" placeholder="Min price"></div>
                <div class="col-sm-6"><input type="text" name="maxPrice" class="form-control control-light" placeholder="Max price"></div>
            </div>

            <label class="label-light" for="property-acres">Type</label>
            <?php
                $items = ArrayHelper::map(PropertyType::find()->all(), 'typeId', 'typeName');
                $items[''] = 'All';
                echo Html::dropDownList('typeId', '', $items, ['class'=>'form-control control-light', 'style'=>'margin-bottom:10px']);
            ?>

            <label class="label-light" for="property-keywords">Keywords</label>
            <div class="row" style="margin-bottom:10px">
                <div class="col-sm-12"><input type="text" name="keywords" class="form-control control-light" placeholder="Lake"></div>
            </div>

            <br/>
            <button type="submit" class="btn btn-primary control-light">Search</button>
            
        </form>
        </div>
    </div>
</div>

