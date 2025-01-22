<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Ingredient\Ingredient */

$this->title = Yii::t('app', 'Update Ingredient: {name}', [
    'name' => property_exists($model, 'name') ? $model->name : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingredients'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ingredient-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
