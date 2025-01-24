<?php
use yii\helpers\Html;
use common\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Chemical\ChemicalIngredientAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Chemical Ingredient Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chemical-ingredient-assignment-index">

    <span class="button-panel">
        <?= Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('app', 'Create Chemical Ingredient Assignment'), ['create'], ['class' => 'btn btn-success']) ?>
    </span>

    <div class="box">
        <div class="box-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'chemical_id',
                        'filter' => $searchModel->chemicalList(),
                        'value' => function ($model) {
                        	return $model->getChemical()->one()->name;
                        },
                    ],
                    [
                        'attribute' => 'ingredient_id',
                        'filter' => $searchModel->ingredientList(),
                        'value' => function ($model) {
                        	return $model->getIngredient()->one()->name;
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>