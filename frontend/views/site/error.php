<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="wd-form-login pb-5">

    <h3 class="pb-5"><?= Html::encode($this->title) ?></h3>

    <div class="alert alert-danger mb-5">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>