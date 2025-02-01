<?php

use core\entities\Match\ChemicalEntomophageMatch;

/* @var $this yii\web\View */
/* @var $searchModel core\entities\Compare\CompareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model core\entities\Compare\Compare */
/* @var $matches ChemicalEntomophageMatch[] */

$this->title = '';

$cols = array_chunk($matches, 1);
?>
<div class="compare-index">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center header">Проверка совместимости</h3>
            </div>
        </div>

        <div class="row">

            <div class="col-md-2">
                <?= $this->render('_compare', ['model' => $model]) ?>
            </div>
            <div class="col-md-10">
                <div class="row">

                    <?php foreach($cols as $rows): ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                            <?php foreach($rows as $entomophage_id => $match): ?>
                                <?= $this->render('_item', ['entomophage_id' => $entomophage_id, 'match' => $match]) ?>
                            <?php endforeach; ?>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

    </div>
</div>