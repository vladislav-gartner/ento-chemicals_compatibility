<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\auth\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('auth','Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('auth','Please choose your new password:')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
