<?php

use core\helpers\IconHelper;
use yii\helpers\Html;
use common\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Match\MatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Matches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-index">

    <span class="button-panel">
        <?= Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('app', 'Create Match'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a('<i class="fa fa-remove"></i> ' . Yii::t('app', 'Truncate All'), ['truncate'], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete all items?'),
                'method' => 'post',
            ],
        ]) ?>
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
                        'attribute' => 'Иконка',
                        'value' => function (\core\entities\Match\Match $model) {
                            return IconHelper::icon($model->icon_class);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align:center'],
                    ],
                    'name',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>