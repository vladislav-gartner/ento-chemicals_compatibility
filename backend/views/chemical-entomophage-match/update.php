<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Match\ChemicalEntomophageMatch */

$this->title = Yii::t('app', 'Update Chemical Entomophage Match: {name}', [
    'name' => property_exists($model, 'id') ? $model->id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Entomophage Matches'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'chemical_id' => $model->chemical_id, 'entomophage_id' => $model->entomophage_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="chemical-entomophage-match-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
