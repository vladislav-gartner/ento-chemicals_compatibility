<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model core\forms\Chemical\ChemicalForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chemical-form">

    <?php $form = ActiveForm::begin(['id' => 'chemical-form']); ?>

    <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body">

        <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

        <fieldset class="section" id="general">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

            <?= $form->field($model, 'status')->checkbox() ?>

        </fieldset>
        </div>
    </div>
    <fieldset class="section" id="ingredients">
        <div class="box box-default">
            <div class="box-header with-border"><?=Yii::t('app','Existing Ingredient')?></div>
            <div class="box-body">
                <?= $form->field($model->ingredients, 'existing')->widget(Select2::class, [
                    'data' => $model->ingredients->ingredientsList(),
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