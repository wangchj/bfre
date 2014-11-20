<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\PropertyType;
use app\assets\AddPropertyAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Property */
/* @var $form yii\widgets\ActiveForm */

AddPropertyAsset::register($this);
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(); ?>

    <h2>Description</h2>

    <?= $form->field($model, 'headline')->textInput(['maxlength' => 30]) ?>
    <?= $form->field($model, 'typeId')->dropDownList(ArrayHelper::map(PropertyType::find()->all(), 'typeId', 'typeName')) ?>
    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'features')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'acres')->textInput() ?>
    <?= $form->field($model, 'price')->textInput() ?>

    <h2>Location</h2>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'state')->dropDownList(['AL'=>'AL','AK'=>'AK','AS'=>'AS','AZ'=>'AZ','AR'=>'AR','CA'=>'CA','CO'=>'CO','CT'=>'CT','DE'=>'DE','DC'=>'DC','FM'=>'FM','FL'=>'FL','GA'=>'GA','GU'=>'GU','HI'=>'HI','ID'=>'ID','IL'=>'IL','IN'=>'IN','IA'=>'IA','KS'=>'KS','KY'=>'KY','LA'=>'LA','ME'=>'ME','MH'=>'MH','MD'=>'MD','MA'=>'MA','MI'=>'MI','MN'=>'MN','MS'=>'MS','MO'=>'MO','MT'=>'MT','NE'=>'NE','NV'=>'NV','NH'=>'NH','NJ'=>'NJ','NM'=>'NM','NY'=>'NY','NC'=>'NC','ND'=>'ND','MP'=>'MP','OH'=>'OH','OK'=>'OK','OR'=>'OR','PW'=>'PW','PA'=>'PA','PR'=>'PR','RI'=>'RI','SC'=>'SC','SD'=>'SD','TN'=>'TN','TX'=>'TX','UT'=>'UT','VT'=>'VT','VI'=>'VI','VA'=>'VA','WA'=>'WA','WV'=>'WV','WI'=>'WI','WY'=>'WY']) ?>


    <label class="control-label" for="property-state">Map Data</label>

    <div id="point"></div>

    <?php
        $field = $form->field($model, 'latlon');
        $field->template = '{input}';
        echo $field->hiddenInput();
    ?>

    <div id="map" style="width:100%;height:500px"></div>
    
    <!-- ?= $form->field($model, 'bound')->textInput() ? -->

    
    <?php
        $field = $form->field($model, 'bound');
        $field->template = '{input}';
        echo $field->hiddenInput();
    ?>
    

    

    <?= $form->field($model, 'pictures')->textarea(['rows' => 6]) ?>

    

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php if(!$model->isNewRecord):?>
<script type="text/javascript">
var pointStr = '<?=$model->latlon?>';
var boundStr = '<?=$model->bound?>';
</script>
<?php endif;?>