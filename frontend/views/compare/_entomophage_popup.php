<?php

use core\entities\Entomophage\Entomophage;
use core\entities\EntomophagePopup\EntomophagePopup;
use yii\web\View;

/* @var $this View */
/* @var $entomophage Entomophage */
/* @var $entomophagePopup EntomophagePopup */

?>
<div class="modal fade info" id="entomophage-modal-<?= $entomophagePopup->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title text-center"><?= $entomophage->name ?></h3>
            </div>
            <div class="modal-body">
                <?= $entomophagePopup->content ?>
            </div>
        </div>
    </div>
</div>
