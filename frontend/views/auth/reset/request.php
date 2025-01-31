<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\PasswordResetRequestForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '';
?>
<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-md-12">

                <div class="login-box">
                    <div class="login-logo">
                        <a href="#"><b>B</b> TECHNOLOGY</a>
                    </div>

                    <div class="login-box-body">
                        <p class="login-box-msg">
                            <?=Yii::t('auth','Please fill out your email. A link to reset password will be sent there.')?>
                        </p>

                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                        <?= $form->field($model, 'email')->label(false)->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

                        <?= Html::submitButton(Yii::t('app','Send'), ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>

                    </div>

                </div>
            </div>
        </div>
</section>
