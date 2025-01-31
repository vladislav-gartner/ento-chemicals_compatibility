<?php

/* @var $this View */
/* @var $model LoginForm */

use core\forms\auth\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = "";
?>
<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-md-12">

                <div class="login-box">
                    <div class="login-logo">
                        <a href="#"><b>FAM</b>TRACKER</a>
                    </div>

                    <div class="login-box-body">
                        <p class="login-box-msg"><?=Yii::t('app','Enter the pin code')?></p>

                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

                        <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
                        ])
                            ->label(false)
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                        <?= $form->field($model, 'username')->label(false)->hiddenInput(['value' => Yii::$app->request->post('username')]); ?>

                        <div class="row">
                            <div class="col-xs-12">
                                <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
