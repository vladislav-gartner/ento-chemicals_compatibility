<?php
use yii\helpers\Html;
use common\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Compare\CompareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Compares');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compare-index">

    <span class="button-panel">
        <?= Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('app', 'Create Compare'), ['create'], ['class' => 'btn btn-success']) ?>
        
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
                        'attribute' => 'user_id',
                        'filter' => $searchModel->userList(),
                        'value' => function ($model) {
                        	return $model->getUser()->one()->username;
                        },
                    ],
                    'created_at:datetime',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>