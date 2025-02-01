<?php

use core\entities\Ingredient\Ingredient;
use core\entities\Match\ChemicalEntomophageMatch;
use core\helpers\CompareHelper;
use function nspl\a\first;

/* @var $this yii\web\View */
/* @var $match ChemicalEntomophageMatch[] */
/* @var $entomophage_id integer */
/* @var $item ChemicalEntomophageMatch */
/* @var $ingredient Ingredient */

/** @var ChemicalEntomophageMatch $match */
$first = first($match);

?>
<div class="box box-solid box-success box-radius card">
    <div class="box-header with-border box-header-radius"><h3 class="text-center"><?= $first->entomophage->name ?></h3></div>
    <div class="box-body">
        <?php foreach($match as $key => $item): ?>

            <div class="content-container">
                <div class="col-md-8 col-sm-8 col-xs-8 left-content">
                    <h3 class="title"><i><?= $item->chemical->name ?></i></h3>
                    <?php foreach($item->chemical->getIngredients()->all() as $ingredient): ?>
                        <?= CompareHelper::labelDefault($ingredient->name, 'label label-primary') ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center right-content">
                    <?= CompareHelper::matchLabel($item->match->id, $item->match->name) ?>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
