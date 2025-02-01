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
                        <img src="/img/logo_xs.webp" width="100px">
                    </div>

                    <div class="login-box-body">
                        <h4 class="login-box-msg">
                            <?=Yii::t('auth','Please fill out your email. A link to reset password will be sent there.')?>
                        </h4>

                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                        <?= $form->field($model, 'email')->label(false)->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

                        <?= Html::submitButton(Yii::t('app','Send'), ['class' => 'btn btn-success full-width-btn']) ?>
                        <?php ActiveForm::end(); ?>

                    </div>

                </div>
            </div>
        </div>
</section>
