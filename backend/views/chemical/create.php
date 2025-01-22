<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Chemical\Chemical */

$this->title = Yii::t('app', 'Create Chemical');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemicals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chemical-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
