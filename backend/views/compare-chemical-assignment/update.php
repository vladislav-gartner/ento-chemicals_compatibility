<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\CompareChemicalAssignment */

$this->title = Yii::t('app', 'Update Compare Chemical Assignment: {name}', [
    'name' => property_exists($model, 'compare_id') ? $model->compare_id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compare Chemical Assignments'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->compare_id, 'url' => ['view', 'compare_id' => $model->compare_id, 'chemical_id' => $model->chemical_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="compare-chemical-assignment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
