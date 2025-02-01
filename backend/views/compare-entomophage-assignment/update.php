<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\CompareEntomophageAssignment */

$this->title = Yii::t('app', 'Update Compare Entomophage Assignment: {name}', [
    'name' => property_exists($model, 'compare_id') ? $model->compare_id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compare Entomophage Assignments'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->compare_id, 'url' => ['view', 'compare_id' => $model->compare_id, 'entomophage_id' => $model->entomophage_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="compare-entomophage-assignment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
