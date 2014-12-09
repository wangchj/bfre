<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-activate">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'fname',
            'lname',
            'email',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'activate' => function($url, $model, $key){
                        return "<a href=\"$url\"><span class=\"glyphicon glyphicon-check\"></span></a>";
                    },
                    'detemp' => function($url, $model, $key){
                        return "<a href=\"$url\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
                    }
                ],
                'template'=>'{activate} {detemp}'
            ],
        ],
    ]); ?>

</div>