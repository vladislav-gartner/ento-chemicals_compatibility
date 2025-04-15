<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\ChemicalPopup\ChemicalPopup */

$this->title = Yii::t('app', 'Create Chemical Popup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Popups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chemical-popup-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
