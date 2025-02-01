<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\LoginForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
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
                        <h4 class="login-box-msg"><?=Yii::t('app','Enter the login and password')?></h4>

                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->label(false)
                            ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('login')]) ?>

                        <?= $form->field($model, 'password', [
                            'options' => ['class' => 'form-group has-feedback'],
                            'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
                        ])
                            ->label(false)
                            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-success full-width-btn', 'name' => 'login-button']) ?>
                        </div>

                        <?= Html::a(Yii::t('auth','Forgot password?'), ['auth/reset/request'], ['class' => 'forgot']) ?>

                        <?= Html::a(Yii::t('auth','Signup'), ['auth/signup/request'], ['class' => 'forgot pull-right']) ?>
                        <?php ActiveForm::end(); ?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
