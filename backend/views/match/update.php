<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Match\Match */

$this->title = Yii::t('app', 'Update Match: {name}', [
    'name' => property_exists($model, 'name') ? $model->name : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matches'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="match-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
