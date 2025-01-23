<?php
use yii\helpers\Html;
use common\components\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Entomophage\EntomophageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Entomophages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entomophage-index">

    <span class="button-panel">
        <?= Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('app', 'Create Entomophage'), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a(
            '<i class="fa fa-upload"></i> ' . Yii::t('app', 'Batch Load'),
            ['batch'],
            ['class' => 'btn btn-primary']
        ) ?>
        
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
                    'name',
                    [
                        'attribute' => 'status',
                        'class' => \common\components\StatusColumn::class,
                        'filter' => \common\components\StatusColumn::statusList(),
                        'format' => 'raw',
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>