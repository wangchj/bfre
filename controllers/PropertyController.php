<?php

namespace app\controllers;

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
                    ['allow'=>true, 'actions'=>['index','detail'], 'roles'=>['?','@']],
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
        $activeQuery = Property::find();

        if($typeId != null)
            $activeQuery->where(['typeId'=>$typeId]);

        return $this->render('index', ['properties' => $activeQuery->all()]);
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
