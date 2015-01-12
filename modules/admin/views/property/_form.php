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

    <?php $form = ActiveForm::begin(['options'=>['class'=>'dropzone','enctype'=>'multipart/form-data']]); ?>

    <h2>Description</h2>

    <?= $form->field($model, 'headline')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'typeId')->dropDownList(ArrayHelper::map(PropertyType::find()->all(), 'typeId', 'typeName')) ?>
    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'features')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'acres')->textInput() ?>
    <?= $form->field($model, 'price',
        ['template' => "{label}<div class=\"input-group\"><div class=\"input-group-addon\">$</div>{input}</div>{error}"])->textInput() ?>

    <h2>Location</h2>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'state')->dropDownList(['AL'=>'AL','AK'=>'AK','AS'=>'AS','AZ'=>'AZ','AR'=>'AR','CA'=>'CA','CO'=>'CO','CT'=>'CT','DE'=>'DE','DC'=>'DC','FM'=>'FM','FL'=>'FL','GA'=>'GA','GU'=>'GU','HI'=>'HI','ID'=>'ID','IL'=>'IL','IN'=>'IN','IA'=>'IA','KS'=>'KS','KY'=>'KY','LA'=>'LA','ME'=>'ME','MH'=>'MH','MD'=>'MD','MA'=>'MA','MI'=>'MI','MN'=>'MN','MS'=>'MS','MO'=>'MO','MT'=>'MT','NE'=>'NE','NV'=>'NV','NH'=>'NH','NJ'=>'NJ','NM'=>'NM','NY'=>'NY','NC'=>'NC','ND'=>'ND','MP'=>'MP','OH'=>'OH','OK'=>'OK','OR'=>'OR','PW'=>'PW','PA'=>'PA','PR'=>'PR','RI'=>'RI','SC'=>'SC','SD'=>'SD','TN'=>'TN','TX'=>'TX','UT'=>'UT','VT'=>'VT','VI'=>'VI','VA'=>'VA','WA'=>'WA','WV'=>'WV','WI'=>'WI','WY'=>'WY']) ?>


    <label class="control-label" for="property-state">Map Data</label>

    <?php
        $field = $form->field($model, 'latlon');
        $field->template = '{input}';
        echo $field->hiddenInput();
    ?>

    <div class="form-group form-inline">
        <div class="input-group col-md-4 col-sm-4 col-sm-offset-1" style="margin-bottom:10px">
            <div class="input-group-addon">Latitude</div>
            <input id="lat" class="form-control" />
        </div>
        <div class="input-group col-md-4 col-sm-4 col-sm-offset-1" style="margin-bottom:10px">
            <div class="input-group-addon">Longitude</div>
            <input id="lon" class="form-control" />
        </div>
    </div>
    
    <div id="map" style="width:100%;height:500px"></div>
    
    <?php
        $field = $form->field($model, 'bound');
        $field->template = '{input}';
        echo $field->hiddenInput();
    ?>
    

    <h2>Pictures</h2>

    <!-- ?= $form->field($model, 'pictures')->textarea(['rows' => 6]) ? -->

    <div class="row">
    <input type="hidden" id="droplist" name="droplist" />
    <?php
    //If this is an existing record, load the photos
    if(!$model->isNewRecord && $model->pictures != null && $model->pictures != ''):
        $photoUrls = explode("\n", $model->pictures);
        for($i = 0; $i < count($photoUrls); $i++):
    ?>
        <div class="photo col-sm-2" id="photo<?=$i?>">
            <div class="thumbnail">
                <img src="<?=$photoUrls[$i]?>" />
                <div class="caption" style="text-align:center">
                    <div class="photo-remove btn btn-default btn-sm" data-id="<?=$i?>" role="button">remove</div>
                </div>
            </div>
        </div>
    <?php endfor; endif;?>
    </div>

    <!-- MAX_FILE_SIZE must precede the file input field -->
    <!-- input type="hidden" name="MAX_FILE_SIZE" value="30000" / -->
    <input type="file" name="uploads[]" multiple="multiple" />
    

    <div class="form-group" style="margin-top:35px">
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