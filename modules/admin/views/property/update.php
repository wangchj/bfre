<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Property */

$this->title = "Update '{$model->headline}'";
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->propId, 'url' => ['view', 'id' => $model->propId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="property-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>