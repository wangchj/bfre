<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Property', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'headline',
            ['label'=>'Type',
                'value'=> function ($property){
                    return $property->type->typeName;
                }
            ],
            'address',
            'city',
            'county',
            'state',
            'acres',
            //'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
