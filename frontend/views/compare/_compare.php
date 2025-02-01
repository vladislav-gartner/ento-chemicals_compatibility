<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model core\forms\Compare\CompareForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compare-form">

    <?php $form = ActiveForm::begin(['id' => 'compare-form']); ?>

    <div class="box box-solid box-success box-radius">
        <div class="box-header with-border box-header-radius"><h3 class="text-center"><?= Yii::t('app', 'Compare') ?></h3></div>
        <div class="box-body">

            <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

            <fieldset class="section" id="general">

                <?= $form->field($model->chemicals, 'existing')->widget(Select2::class, [
                    'data' => $model->chemicals->chemicalsList(),
                    'options' => ['placeholder' => 'Выбрать из списка', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'theme' => Select2::THEME_DEFAULT
                ])->label(true) ?>

                <?= $form->field($model->entomophages, 'existing')->widget(Select2::class, [
                    'data' => $model->entomophages->entomophagesList(),
                    'options' => ['placeholder' => 'Выбрать из списка', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'theme' => Select2::THEME_DEFAULT
                ])->label(true) ?>

                <?= Html::submitButton('<i class="fa fa-balance-scale"></i> ' . Yii::t('app', 'Compare'), ['class' => 'btn btn-success col-md-12 col-sm-12 col-xs-12']) ?>

            </fieldset>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>