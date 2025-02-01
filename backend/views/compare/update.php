<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\Compare */

$this->title = Yii::t('app', 'Update Compare: {name}', [
    'name' => property_exists($model, 'id') ? $model->id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compares'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="compare-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
