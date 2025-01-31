<?php

/* @var $this yii\web\View */

use core\entities\User\User;
use frontend\widgets\BreadcrumbWidget;
use insolita\wgadminlte\LteConst;
use insolita\wgadminlte\LteSmallBox;
use yii\helpers\Url;

if (!Yii::$app->user->isGuest) {
    /** @var User $user */
    $user = Yii::$app->user->identity->getUser();
}

$this->title = '';
?>
<?= BreadcrumbWidget::widget([]) ?>
<section class="account-section">
    <div class="tf-container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</section>