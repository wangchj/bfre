<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Property;
use app\models\PropertyType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\geonames\UsStates;

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
                    ['allow'=>true, 'actions'=>['index','detail','type'], 'roles'=>['?','@']],
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
    public function actionIndex($typeId = null,
        $typeName = null,
        $minPrice = null, $maxPrice = null, 
        $minAcres = null, $maxAcres = null,
        $keywords = null, $state = null)
    {
        $activeQuery = Property::find();

        if($typeName && $typeName != '') {
            $type = PropertyType::find()->where(['typeName'=>$typeName])->one();
            $activeQuery->where('typeId='. $type->typeId);
        }
        else if($typeId && $typeId != '' && is_numeric($typeId)) {
            $activeQuery->where('typeId='. $typeId);
            $typeName = PropertyType::find($typeId)->typeName;
        }

        if($minPrice != null && $minPrice != '' && is_numeric($minPrice))
            $activeQuery->andWhere('(' . 'priceTotal>=' . $minPrice . ' OR priceAcre>=' . $minPrice . ')');

        if($maxPrice != null && $maxPrice != '' && is_numeric($maxPrice))
            $activeQuery->andWhere('(' . 'priceTotal<=' . $maxPrice . ' OR priceAcre<=' . $maxPrice . ')');

        if($minAcres != null && $minAcres != '' && is_numeric($minAcres))
            $activeQuery->andWhere('acres>='. $minAcres);

        if($maxAcres != null && $maxAcres != '' && is_numeric($maxAcres))
            $activeQuery->andWhere('acres<='. $maxAcres);

        if($keywords != null && $keywords != '')
            $activeQuery->andWhere("match(descr,features) against ('$keywords')");

        if($state) {
            $code = UsStates::ntoc($state);
            $activeQuery->andWhere("state='$code'");
        }

        $activeQuery->andWhere("status='active'");
        
        return $this->render('index', ['properties' => $activeQuery->all(), 'type'=>$typeName]);
    }

    public function actionType($typeName) {
        $activeQuery = Property::find();

        if($typeName && $typeName != '') {
            $typeId = PropertyType::find()->where(['typeName'=>$typeName])->one()->typeId;
            $activeQuery->innerJoinWith('propertyTypeMaps')->where(['typeId'=>$typeId]);
        }

        return $this->render('index', ['properties' => $activeQuery->all(), 'type'=>$typeName]);
    }

    /**
     * Displays a single Property model.
     * @param integer $id
     * @return mixed
     */
    public function actionDetail($id)
    {
        return $this->render('detail', [
            'property' => $this->findModel($id),
        ]);
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
