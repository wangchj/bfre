<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contact Bill Fowler Real Estate';
$this->registerMetaTag(['name'=>'keywords', 'content'=>'Sales, offers, buy, questions, inquiries, land sale questions, business, contact, email, form']);
?>

<div style="height:300px; overflow:hidden;">
    <img style="width:100%; position:relative; top:-290px; left:0px; min-width:1268px" src="http://billfowlerrealestate.com/photos/54d929b016cdf/106_2392.JPG">
</div>

<div class="container" style="padding-top:0px">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <h1>Contact Us</h1>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?> 
                <div class="alert alert-success" style="margin-top:30px">
                    Thank you for contacting us. We will respond to you as soon as possible.
                </div>

                <!-- p>
                Note that if you turn on the Yii debugger, you should be able
                to view the mail message on the mail panel of the debugger.
                <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
                </p -->
            <?php endif; ?>
            

            <?php else: ?>

            <p>
            For business inquiries or other questions, please fill out the following form to contact us. Thank you.
            </p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-sm-3">{image}</div><div class="col-sm-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
