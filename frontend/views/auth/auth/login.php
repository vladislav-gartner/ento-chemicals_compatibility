<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\LoginForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app','Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= BreadcrumbWidget::widget([]) ?>

<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="wd-form-login pb-5">

                <h4><?= Html::encode($this->title) ?></h4>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <div class="ip">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="ip">
                    <?= $form->field($model, 'password', [
                        'inputTemplate' => '<div class="inputs-group auth-pass-inputgroup">{input}<a class="icon-eye-off password-addon"></a></div>',
                    ])->passwordInput([
                        'class' => 'input-form password-input'
                    ]) ?>
                </div>

                <div class="group-ant-choice">
                    <div class="sub-ip">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                    <?= Html::a(Yii::t('auth','Forgot password?'), ['auth/reset/request'], ['class' => 'forgot']) ?>
                </div>

                <p class="line-ip"><span><?=Yii::t('auth','or sign up with')?></span></p>

                <?= yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['auth/network/auth']
                ]); ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>