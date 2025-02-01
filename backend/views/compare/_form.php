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

    <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body">

        <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

        <fieldset class="section" id="general">
            <?= $form->field($model, 'user_id')->dropdownList(
                    yii\helpers\ArrayHelper::merge(['0' => 'Выбрать из списка'],
                    \core\entities\User\User::find()->active()->select(['username', 'id'])->indexBy('id')->column())
            ) ?>

        </fieldset>
        </div>
    </div>
    <fieldset class="section" id="chemicals">
        <div class="box box-default">
            <div class="box-header with-border"><?=Yii::t('app','Existing Chemical')?></div>
            <div class="box-body">
                <?= $form->field($model->chemicals, 'existing')->widget(Select2::class, [
                    'data' => $model->chemicals->chemicalsList(),
                    'options' => ['placeholder' => 'Выбрать из списка', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'theme' => Select2::THEME_DEFAULT
                ])->label(false) ?>
            </div>
        </div>
    </fieldset>
    <fieldset class="section" id="entomophages">
        <div class="box box-default">
            <div class="box-header with-border"><?=Yii::t('app','Existing Entomophage')?></div>
            <div class="box-body">
                <?= $form->field($model->entomophages, 'existing')->widget(Select2::class, [
                    'data' => $model->entomophages->entomophagesList(),
                    'options' => ['placeholder' => 'Выбрать из списка', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'theme' => Select2::THEME_DEFAULT
                ])->label(false) ?>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>