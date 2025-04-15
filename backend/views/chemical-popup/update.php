<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\ChemicalPopup\ChemicalPopup */

$this->title = Yii::t('app', 'Update Chemical Popup: {name}', [
    'name' => property_exists($model, 'id') ? $model->id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Popups'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="chemical-popup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
