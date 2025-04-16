<?php

use core\entities\Chemical\Chemical;
use core\entities\ChemicalPopup\ChemicalPopup;
use yii\web\View;

/* @var $this View */
/* @var $chemicalPopup ChemicalPopup */
/* @var $chemical Chemical */

?>
<div class="modal fade info" id="chemical-modal-<?= $chemicalPopup->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title text-center"><?= $chemical->name ?></h3>
            </div>
            <div class="modal-body">
                <?= $chemicalPopup->content ?>
            </div>
        </div>
    </div>
</div>