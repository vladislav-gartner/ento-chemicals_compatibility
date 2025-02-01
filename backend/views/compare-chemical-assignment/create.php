<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\CompareChemicalAssignment */

$this->title = Yii::t('app', 'Create Compare Chemical Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compare Chemical Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compare-chemical-assignment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
