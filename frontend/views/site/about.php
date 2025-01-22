<?php

/* @var $this yii\web\View */

use frontend\widgets\BreadcrumbWidget;
use yii\helpers\Html;

$this->title = Yii::t('app','About');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= BreadcrumbWidget::widget([]) ?>

<section class="account-section">
    <div class="tf-container">
        <div class="row">

            <h4 class="mb-5"><?= Html::encode($this->title) ?></h4>

            <p>This is the About page. You may modify the following file to customize its content:</p>

            <code><?= __FILE__ ?></code>

        </div>
    </div>
</section>
