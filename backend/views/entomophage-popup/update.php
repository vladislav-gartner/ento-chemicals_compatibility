<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\EntomophagePopup\EntomophagePopup */

$this->title = Yii::t('app', 'Update Entomophage Popup: {name}', [
    'name' => property_exists($model, 'id') ? $model->id : '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entomophage Popups'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="entomophage-popup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
