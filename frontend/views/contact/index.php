<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model core\forms\ContactForm */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app','Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= BreadcrumbWidget::widget([]) ?>

<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="wd-form-login pb-5">

                <h4><?= Html::encode($this->title) ?></h4>

                <?=Yii::t('app','If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.')?>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <div class="ip">
                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="ip">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="ip">
                        <?= $form->field($model, 'subject') ?>
                    </div>
                    <div class="ip">
                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="ip">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>
                    </div>

                    <?= Html::submitButton(Yii::t('app','Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>