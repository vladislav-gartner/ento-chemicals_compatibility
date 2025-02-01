<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\Compare\CompareChemicalAssignment */

$this->title = $model->compare_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compare Chemical Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="compare-chemical-assignment-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> ' . Yii::t('app', 'Update'), ['update', 'compare_id' => $model->compare_id, 'chemical_id' => $model->chemical_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-remove"></i> ' . Yii::t('app', 'Delete'), ['delete', 'compare_id' => $model->compare_id, 'chemical_id' => $model->chemical_id], [
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
                    'compare_id',
                    'chemical_id',
                ],
            ]) ?>

        </div>
    </div>

</div>
