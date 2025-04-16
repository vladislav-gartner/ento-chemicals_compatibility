<?php

use core\entities\Entomophage\Entomophage;
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
    <div class="box-header with-border box-header-radius">
        <?php
            /** @var Entomophage $entomophage */
            $entomophage = $first->entomophage;
            $entomophagePopup = $entomophage->entomophagePopup;
        ?>
        <h3 class="text-center">
            <?= $entomophage->name ?>
            <?php if ($entomophagePopup): ?>
                <span class="custom-icon-info-white clickable-icon" data-toggle="modal" data-target="#entomophage-modal-<?= $entomophagePopup->id ?>" title="Показать информацию"></span>
            <?php endif; ?>
        </h3>
    </div>
    <div class="box-body">
        <?php foreach($match as $key => $item): ?>
            <?php
                $chemical = $item->chemical;
                $chemicalPopup = $chemical->chemicalPopup;
            ?>
            <div class="content-container">
                <div class="col-md-8 col-sm-8 col-xs-8 left-content">
                    <h3 class="title">
                        <i><?= $chemical->name ?></i>
                        <?php if ($chemicalPopup): ?>
                            <span class="custom-icon-info-green clickable-icon" data-toggle="modal" data-target="#chemical-modal-<?= $chemicalPopup->id ?>" title="Показать информацию"></span>
                        <?php endif; ?>
                    </h3>
                    <?php foreach($chemical->getIngredients()->all() as $ingredient): ?>
                        <?= CompareHelper::labelDefault($ingredient->name, 'label label-primary') ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center right-content">
                    <?= CompareHelper::matchLabel($item->match->id, $item->match->name) ?>
                </div>
            </div>
            <?php if ($chemicalPopup): ?>
                <?= $this->render('_chemical_popup', ['chemicalPopup' => $chemicalPopup, 'chemical' => $chemical]) ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php if ($entomophagePopup): ?>
    <?= $this->render('_entomophage_popup', ['entomophagePopup' => $entomophagePopup, 'entomophage' => $entomophage]) ?>
<?php endif; ?>