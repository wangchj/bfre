<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = Yii::$app->name . ' Contact';
?>
<div class="container" style="padding-top:0px">

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            
            <h2>Contact Us</h2>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?> 
                <div class="alert alert-success">
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
            If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
            </p>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-sm-3">{image}</div><div class="col-sm-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
