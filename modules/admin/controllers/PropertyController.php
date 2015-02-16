<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Property;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    ['allow'=>true, 'actions'=>['index','create','update','delete', 'view'], 'roles'=>['@']],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Property models.
     * @param $typeId integer
     * @return mixed
     */
    public function actionIndex($typeId = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Property::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Property model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Property model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Property();
        
        if ($model->load(Yii::$app->request->post()) && self::validatePrices($model))
        {
            $model->acres = str_replace(',', '', $model->acres);
            $model->priceAcre = str_replace(',', '', $model->priceAcre);
            $model->priceTotal = str_replace(',', '', $model->priceTotal);
            
            $this->addPhoto($model);
            
            if($model->save())
                return $this->redirect(['view', 'id' => $model->propId]);
        }
        
        return $this->render('create', ['model' => $model]); 
    }

    /**
     * Updates an existing Property model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && self::validatePrices($model))
        {
            $model->acres = str_replace(',', '', $model->acres);
            $model->priceAcre = str_replace(',', '', $model->priceAcre);
            $model->priceTotal = str_replace(',', '', $model->priceTotal);

            $this->dropPhoto($model);
            $this->addPhoto($model);


            if($model->save())
                return $this->redirect(['view', 'id' => $model->propId]);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Validates price per acre and total price combination: one (or both) of the two prices must be specified.
     * @param $property Property model object.
     * @return true if one of the price is present; false if both inputs are empty.
     */
    private static function validatePrices($property)
    {
        if(($property->priceAcre == null || $property->priceAcre == '') && ($property->priceTotal == null || $property->priceTotal == ''))
        {
            $property->addError('priceAcre', '\'Price Per Acre\' and \'Total Price\' cannot both be empty.');
            return false;
        }
        return true;
    }

    /**
     * Process file upload. Overwrite if file already exist.
     * @param $property an Property instance.
     */
    private function addPhoto($property)
    {
        if(!$_FILES)
            return;

        $files = $_FILES['uploads'];

        //Create directory for photos
        $uniqid  = uniqid();
        $dirPath = Yii::getAlias('@webroot/photos/' . $uniqid);
        $dirUrl  = Url::to('@web/photos/' . $uniqid);

        mkdir($dirPath);

        foreach($files['name'] as $index => $name)
        {
            if(!$files['error'][$index] && move_uploaded_file($files['tmp_name'][$index], "{$dirPath}/{$name}"))
            {
                if($property->pictures != null && $property->pictures != '')
                    $property->pictures .= "\n";
                $property->pictures .= "{$dirUrl}/{$name}";
            }
        }
    }

    /**
     * Process drop list from POST
     * @param $property an Property model object.
     */
    private function dropPhoto($property)
    {
        //If nothing to drop, do nothing
        if(!isset($_POST['droplist']) || $_POST['droplist'] == '')
            return;

        $dropList = explode(',', $_POST['droplist']);
        $fromList = explode("\n", $property->pictures);
        sort($dropList);
        for($i = count($dropList) - 1; $i >= 0; $i--)
            unset($fromList[$dropList[$i]]);
        
        //TODO: physically remove photo from disk

        $property->pictures = implode("\n", $fromList);
    }

    /**
     * Deletes an existing Property model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
