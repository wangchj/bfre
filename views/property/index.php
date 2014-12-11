<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\PropertyType;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name . ' Properties';

setlocale(LC_MONETARY, 'en_US');

?>
<div class="container" style="padding-top:0px">

    <!-- h1><?= Html::encode($this->title) ?></h1 -->

    <div class="row">

        <div class="col-sm-9">

            <h2 style="margin-bottom:30px">Properties</h2>

            <?php if(count($properties) == 0) echo 'No properties found. Please refine your search.'; ?>

            <?php foreach($properties as $property):?>

                <div class="row property_root" style="margin-bottom:25px; padding-bottom:25px; border-bottom:1px dotted">
                    
                    <div class="col-sm-5">
                        <!-- Photo -->
                        <img src="<?=getFirstPhotoUrl($property)?>" class="img-thumbnail"/>
                    </div>

                    <div class="col-sm-7">
                            
                            <!-- Property Headline -->
                            <div class="property_headline" style="font-size:18px">
                                <a href="<?=Url::to(['property/detail', 'id'=>$property->propId])?>"><?=$property->headline?></a>
                            </div>

                            <!-- Property address, city, county, state -->
                            <div class="property_state" style="margin-bottom:10px">
                                <?php if($property->address != null):?><?=$property->address?>, <?php endif;?>
                                <?php if($property->city != null):?><?=$property->city?>,<?php endif;?>
                                <?=$property->county?>, <?=$property->state?>
                            </div>

                            <?php
                                if(strlen($property->descr) > 500)
                                    echo substr($property->descr, 0, 500) . 
                                        Html::a(' more..', ['property/detail', 'id'=>$property->propId]);
                                else
                                    echo $property->descr;
                            ?>
                        <div style="margin-top:10px"><?=number_format($property->acres,2)?> acres | $<?=number_format($property->price)?></div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class="col-sm-3" style="margin-top:20px">
            <h3>Search</h3>

            <form action="<?=Url::to(['property/index'])?>">

                <label class="label-light" for="property-acres">Acres</label>
                <div class="row" style="margin-bottom:10px">
                    <div class="col-sm-6"><input type="text" name="minAcres" class="form-control control-light" placeholder="Min acres" <?php if(isset($_REQUEST['minAcres'])):?>value="<?=$_REQUEST['minAcres']?>"<?php endif;?>></div>
                    <div class="col-sm-6"><input type="text" name="maxAcres" class="form-control control-light" placeholder="Max acres" <?php if(isset($_REQUEST['minAcres'])):?>value="<?=$_REQUEST['maxAcres']?>"<?php endif;?>></div>
                </div>

                <label class="label-light" for="property-acres">Price</label>
                <div class="row" style="margin-bottom:10px">
                    <div class="col-sm-6"><input type="text" name="minPrice" class="form-control control-light" placeholder="Min price" <?php if(isset($_REQUEST['minPrice'])):?>value="<?=$_REQUEST['minPrice']?>"<?php endif;?>></div>
                    <div class="col-sm-6"><input type="text" name="maxPrice" class="form-control control-light" placeholder="Max price" <?php if(isset($_REQUEST['maxPrice'])):?>value="<?=$_REQUEST['maxPrice']?>"<?php endif;?>></div>
                </div>

                <label class="label-light" for="property-acres">Type</label>
                <?php
                    $items = ArrayHelper::map(PropertyType::find()->all(), 'typeId', 'typeName');
                    $items[''] = 'All';
                    echo Html::dropDownList('typeId',  isset($_REQUEST['typeId']) ? $_REQUEST['typeId'] : '', $items, ['class'=>'form-control control-light']);
                ?>

                <br/>
                <button type="submit" class="btn btn-primary control-light">Search</button>
                
            </form>
        </div>
    </div>
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