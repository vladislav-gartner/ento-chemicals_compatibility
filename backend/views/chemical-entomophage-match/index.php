<?php
use yii\helpers\Html;
use common\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Match\ChemicalEntomophageMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Chemical Entomophage Matches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chemical-entomophage-match-index">

    <span class="button-panel">
        <?= Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('app', 'Create Chemical Entomophage Match'), ['create'], ['class' => 'btn btn-success']) ?>
    </span>

    <div class="box">
        <div class="box-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'common\components\SIDColumn'],
                    [
                        'attribute' => 'chemical_id',
                        'filter' => $searchModel->chemicalList(),
                        'value' => function ($model) {
                        	return $model->getChemical()->one()->name;
                        },
                    ],
                    [
                        'attribute' => 'entomophage_id',
                        'filter' => $searchModel->entomophageList(),
                        'value' => function ($model) {
                        	return $model->getEntomophage()->one()->name;
                        },
                    ],
                    [
                        'attribute' => 'match_id',
                        'filter' => $searchModel->matchList(),
                        'value' => function ($model) {
                        	return $model->getMatch()->one()->name;
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>