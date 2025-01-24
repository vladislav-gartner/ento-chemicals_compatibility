<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Chemical\ChemicalIngredientAssignment */

$this->title = Yii::t('app', 'Update Chemical Ingredient Assignment: {name}', [
    'name' => property_exists($model, 'chemical_id') ? $model->chemical_id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Ingredient Assignments'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->chemical_id, 'url' => ['view', 'chemical_id' => $model->chemical_id, 'ingredient_id' => $model->ingredient_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="chemical-ingredient-assignment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
