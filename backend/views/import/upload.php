<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('app', 'Upload Data');

?>
<div class="product-brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body">

            <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

            <fieldset class="section" id="general">

                <?= $form->field($model, 'file')->fileInput() ?>

            </fieldset>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
