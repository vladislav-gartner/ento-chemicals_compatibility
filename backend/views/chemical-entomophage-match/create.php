<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Match\ChemicalEntomophageMatch */

$this->title = Yii::t('app', 'Create Chemical Entomophage Match');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Entomophage Matches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chemical-entomophage-match-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
