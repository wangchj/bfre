<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use SendGrid;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        $form->load(Yii::$app->request->post());
        $user = User::findOne(['email'=>$form->email]);
        if($user != null && password_verify($form->password, $user->phash))
        {
            Yii::$app->user->login($user, $form->rememberMe ? 3600*24*30 : 0);
            return $this->goBack();
        }
        else
            return $this->render('login', ['model' => $form,]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $username = Yii::$app->params['sendgrid']['username'];
            $password = Yii::$app->params['sendgrid']['password'];
            $toAddr   = Yii::$app->params['adminEmail'];

            $sendgrid = new SendGrid($username, $password);

            $mail = new SendGrid\Email();

            $mail->setFrom(Yii::$app->params['contact']['sender']);
            $mail->setReplyTo($model->email);
            $mail->setTos(Yii::$app->params['contact']['receivers']);
            
            $mail->setSubject("Bill Fowler Real Estate message from {$model->name}");
            $mail->setText("Message from: {$model->name} ({$model->email})\n\n {$model->body}");

            $sendgrid->send($mail);

            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        else
        {
            return $this->render('contact', ['model' => $model]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
