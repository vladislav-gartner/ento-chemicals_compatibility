<?php

/* @var $this yii\web\View */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Cabinet');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= BreadcrumbWidget::widget([]) ?>

<section class="account-section">
    <div class="tf-container">
        <div class="row">

            <h3 class="mb-5"><?= Html::encode($this->title) ?></h3>

            <h5><?= Yii::t('auth', 'Attach social network:') ?></h5>

            <div class="mb-5">
                <?= yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['cabinet/network/attach'],
                ]); ?>
            </div>

        </div>
    </div>
</section>