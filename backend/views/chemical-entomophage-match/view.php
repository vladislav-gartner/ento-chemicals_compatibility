<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\Match\ChemicalEntomophageMatch */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chemical Entomophage Matches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="chemical-entomophage-match-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-remove"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-default">
        <div class="box-header with-border"></div>
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'chemical_id',
                    'entomophage_id',
                    'match_id',
                ],
            ]) ?>

        </div>
    </div>

</div>
