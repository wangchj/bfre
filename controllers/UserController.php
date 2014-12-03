<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\TempUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>AccessControl::className(),
                'rules'=>[
                    ['allow'=>true, 'actions'=>['index','create','update','delete','view'], 'roles'=>['@']],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Render sign-up form
     */
    public function actionSignup()
    {
        $tempUser = new TempUser();
        
        if(Yii::$app->request->isPost && $tempUser->load(Yii::$app->request->post()))
        {
            //Check email already exist
            if(User::findOne(['email'=>$tempUser->email]) != null || TempUser::findOne(['email'=>$tempUser->email]) != null)
                $tempUser->addError('email', 'User with given email already exist');

            if(!$tempUser->hasErrors())
            {    
                $tempUser->phash = password_hash($tempUser->phash, PASSWORD_BCRYPT);
                $tempUser->authKey = Yii::$app->getSecurity()->generateRandomString();
                
                if($tempUser->save())
                    $this->goHome();
                else
                    var_dump($tempUser->errors);
                //return $this->goHome();
            }
        }

        return $this->render('signup', ['model' => $tempUser]);
    }

    /**
     * Copy a user from TempUser to User table.
     * @param $id integer Database TempUsers table id.
     */
    public function actionActivate($id = null)
    {
        if($id != null)
        {
            $tempUser = TempUser::findOne(['userId'=>$id]);

            if($tempUser != null)
            {
                $user = new User;
                $user->email = $tempUser->email;
                $user->phash = $tempUser->phash;
                $user->fname = $tempUser->fname;
                $user->lname = $tempUser->lname;
                $user->authKey = $tempUser->authKey;
                $user->save();

                $tempUser->delete();
            }
        }

        $dataProvider = new ActiveDataProvider(['query' => TempUser::find()]);
        return $this->render('activate', ['dataProvider' => $dataProvider]);
    }

    /**
     * Delete a temp user from database.
     * @param @id integer TempUser table id.
     */
    public function actionDetemp($id)
    {
        $tempUser = TempUser::findOne(['userId'=>$id]);

        if($tempUser != null)
            $tempUser->delete();
        
        $this->redirect(['activate']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
