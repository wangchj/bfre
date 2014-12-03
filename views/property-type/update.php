<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PropertyType */

$this->title = 'Update Property Type: ' . ' ' . $model->typeId;
$this->params['breadcrumbs'][] = ['label' => 'Property Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->typeId, 'url' => ['view', 'id' => $model->typeId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
