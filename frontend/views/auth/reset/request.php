<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\PasswordResetRequestForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('auth','Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= BreadcrumbWidget::widget([]) ?>

<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="wd-form-login pb-5">

                <h4><?= Html::encode($this->title) ?></h4>
                <?=Yii::t('auth','Please fill out your email. A link to reset password will be sent there.')?>

                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <div class="ip">
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                    </div>
                    <?= Html::submitButton(Yii::t('app','Send'), ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
