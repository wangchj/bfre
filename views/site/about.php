<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = Yii::$app->name . ' About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="height:350px; overflow:hidden">
    <img style="width:100%; position:relative; top:-250px" src="http://www.ncwine.org/img/_home/_gallery/feb_time_wine.jpg">
</div>

<div class="container" style="padding-top:0px">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <h1>About Us</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <p>
            For decades the professionals at Bill Fowler Real Estate have served a wide variety of clients including individuals,
            corporations, banks and attorneys with both personal care and absolute integrity. The application of high-energy and
            dedicated expertise, coupled with a professional attitude that is focused on service, has ensured our clients that,
            regardless of the complexity of the real estate issue or the difficulty in satisfying diverse goals, an optimum
            solution to their real estate problems will be efficiency concluded in a timely manner.
            </p>

            <p>
            Bill Fowler Real Estate operates in the Southeastern United Sates and specializes in purchasing and selling Land,
            Commercial Properties, and 1031 Tax-Differed Exchanges. For almost five decades in business, our company has
            experienced the full spectrum of issues involved in every aspect of real estate transactions, some of which were
            extremely complicated.
            </p>

            <p>
            The services provided have ranged from the sale of a single property to complicated transactions involving the sale
            and exchange of multiple properties. Our company has been successful in transactions that involved numerous entities
            with diverse goals. Succeeding where other have been unable to craft a deal that satisfies everyone continues to be a
            hallmark of the company.
            </p>
        </div>
    </div>

    <div class="row" style="margin-top:15px">
        <div class="col-xs-10 col-xs-offset-1">
            <h1>People</h1>
        </div>
    </div>

    <div class="row" style="margin-top:20px">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="row">
                <div class="col-xs-2">
                    <img src="<?=Yii::getAlias('@web') . '/images/Photo.jpg'?>" style="width:100%">
                </div>
                <div class="col-xs-10 person-card">
                    <b>John Doe</b> <br>
                    <a href="">john.doe@billfowlerrealestate.com</a> <br>
                    
                    John is a design educator, graphic designer, and interactive designer. He has been teaching and
                    practicing graphic design and interactive design since 1999. His main areas of expertise include
                    branding strategy, user experience design, interactive design, and mobile app design.

                    Over the years, he has received many design awards, including Addy Awards, Horizon International
                    Interactive Design Awards, Summit International Creative Awards, UCDA Design Award, AIGA Design
                    Award, One Show Award, and Interactive Media Award.
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 person-card">
                    <img src="<?=Yii::getAlias('@web') . '/images/no-photo.png'?>" style="width:100%">
                </div>
                <div class="col-xs-10">
                    <b>Bill Doe</b> <br>
                    <a href="">bill.doe@billfowlerrealestate.com</a> <br>
                    Bill is a design educator, graphic designer, and interactive designer. He has been teaching and
                    practicing graphic design and interactive design since 1999. His main areas of expertise include
                    branding strategy, user experience design, interactive design, and mobile app design.
                </div>
            </div>
        </div>
    </div>
</div>
