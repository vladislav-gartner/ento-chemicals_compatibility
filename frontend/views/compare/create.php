<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\Compare */

$this->title = Yii::t('app', 'Create Compare');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compare-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
