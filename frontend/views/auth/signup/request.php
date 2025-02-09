<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\SignupForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '';
//$this->params['breadcrumbs'][] = Yii::t('app','Signup');
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
                        <h4 class="login-box-msg"><?=Yii::t('app','Signup')?></h4>

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'fio')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('fio')]) ?>

                            <?= $form->field($model, 'company')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('company')]) ?>

                            <?= $form->field($model, 'email')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

                            <?= $form->field($model, 'password', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
                            ])
                                ->label(false)
                                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                            <?= Html::submitButton(Yii::t('auth','Signup'), ['class' => 'btn btn-success full-width-btn', 'name' => 'signup-button']) ?>

                        <?php ActiveForm::end(); ?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>