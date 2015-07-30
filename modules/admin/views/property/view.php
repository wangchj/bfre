<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Property */

$this->title = $model->headline;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('User View', ['/property/detail', 'id' => $model->propId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->propId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->propId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'propId',
            ['label'=>'Type', 'value'=>$model->getTypeStr()],
            'headline',
            'descr:ntext',
            'features:ntext',
            'keywords:ntext',
            'address',
            'city',
            'county',
            'state',
            'pictures:ntext',
            'latlon',
            'bound',
            ['attribute'=>'acres', 'value'=>number_format($model->acres,2)],
            ['attribute'=>'priceAcre', 'value'=>'$' . number_format($model->priceAcre)],
            ['attribute'=>'priceTotal', 'value'=>'$' . number_format($model->priceTotal)],
        ],
    ]) ?>

</div>
