<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Chemical\Chemical */

$this->title = Yii::t('app', 'Update Chemical: {name}', [
    'name' => property_exists($model, 'name') ? $model->name : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemicals'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="chemical-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
