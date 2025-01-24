<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Chemical\ChemicalIngredientAssignment */

$this->title = Yii::t('app', 'Create Chemical Ingredient Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Ingredient Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chemical-ingredient-assignment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
