<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\SignupForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('auth','Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= BreadcrumbWidget::widget([]) ?>

<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="wd-form-login tf-tab">

                <h4><?= Html::encode($this->title) ?></h4>

                <div class="content-tab">
                    <div class="inner">

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <div class="ip">
                            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="ip">
                            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="ip">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="ip">
                            <?= $form->field($model, 'email') ?>
                        </div>
                        <div class="ip">
                            <?= $form->field($model, 'password', [
                                'inputTemplate' => '<div class="inputs-group auth-pass-inputgroup">{input}<a class="icon-eye-off password-addon"></a></div>',
                            ])->passwordInput([
                                'class' => 'input-form password-input'
                            ]) ?>
                        </div>
                        <?= Html::submitButton(Yii::t('auth','Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                    <?php ActiveForm::end(); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
