<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\EntomophagePopup\EntomophagePopup */

$this->title = Yii::t('app', 'Create Entomophage Popup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entomophage Popups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entomophage-popup-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
