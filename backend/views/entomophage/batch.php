<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \yii\base\DynamicModel */

$this->title = Yii::t('app', 'Batch Load');
?>
<div class="batch-form">

    <?php  $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border"> </div>
        <div class="box-body">

            <?= $form->errorSummary($model, ['class' => 'callout callout-danger']); ?>

            <?= $form->field($model, 'file')->fileInput() ?>

        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Сохранить</button>    </div>

    <?php  ActiveForm::end(); ?>

</div>