<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Entomophage\Entomophage */

$this->title = Yii::t('app', 'Create Entomophage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entomophages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entomophage-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
