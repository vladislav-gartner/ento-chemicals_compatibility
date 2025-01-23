<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model core\entities\Match\Match */

$this->title = Yii::t('app', 'Create Match');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
