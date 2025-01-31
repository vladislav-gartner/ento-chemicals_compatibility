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
                        <a href="#"><b>B</b> TECHNOLOGY</a>
                    </div>

                    <div class="login-box-body">
                        <p class="login-box-msg"><?=Yii::t('app','Signup')?></p>

                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'first_name')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('first_name')]) ?>

                            <?= $form->field($model, 'last_name')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('last_name')]) ?>

                            <?= $form->field($model, 'username')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('username')]) ?>

                            <?= $form->field($model, 'email')->label(false)
                                ->textInput(['autofocus' => true, 'placeholder' => $model->getAttributeLabel('email')]) ?>

                            <?= $form->field($model, 'password', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
                            ])
                                ->label(false)
                                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                            <?= Html::submitButton(Yii::t('auth','Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                        <?php ActiveForm::end(); ?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>