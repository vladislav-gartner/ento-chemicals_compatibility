<?php
use yii\helpers\Html;
use common\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Compare\CompareChemicalAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Compare Chemical Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compare-chemical-assignment-index">

    <span class="button-panel">
        <?= Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('app', 'Create Compare Chemical Assignment'), ['create'], ['class' => 'btn btn-success']) ?>
    </span>

    <div class="box">
        <div class="box-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'compare_id',
                        'filter' => $searchModel->compareList(),
                        'value' => function ($model) {
                        	return $model->getCompare()->one()->id;
                        },
                    ],
                    [
                        'attribute' => 'chemical_id',
                        'filter' => $searchModel->chemicalList(),
                        'value' => function ($model) {
                        	return $model->getChemical()->one()->name;
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>