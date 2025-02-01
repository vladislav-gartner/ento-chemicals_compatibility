<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\CompareEntomophageAssignment */

$this->title = Yii::t('app', 'Create Compare Entomophage Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compare Entomophage Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compare-entomophage-assignment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
