<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\forms\Chemical\ChemicalIngredientAssignmentForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chemical-ingredient-assignment-form">

    <?php $form = ActiveForm::begin(['id' => 'chemical-ingredient-assignment-form']); ?>

    <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body">

        <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

        <fieldset class="section" id="general">
            <?= $form->field($model, 'chemical_id')->dropdownList(
                    yii\helpers\ArrayHelper::merge(['0' => 'Выбрать из списка'],
                    \core\entities\Chemical\Chemical::find()->active()->select(['name', 'id'])->indexBy('id')->column())
            ) ?>
            <?= $form->field($model, 'ingredient_id')->dropdownList(
                    yii\helpers\ArrayHelper::merge(['0' => 'Выбрать из списка'],
                    \core\entities\Ingredient\Ingredient::find()->active()->select(['name', 'id'])->indexBy('id')->column())
            ) ?>

        </fieldset>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>