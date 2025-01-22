<?php

/* @var $this View */

use yii\helpers\Url;
use yii\web\View;

?>
<nav id="main-nav" class="main-nav">
    <ul id="menu-primary-menu" class="menu">
        <li class="menu-item">
            <a href="/"><?=Yii::t('app','Home')?> </a>
        </li>
        <li class="menu-item">
            <a href="<?= Url::to(['site/about']) ?>"><?=Yii::t('app','About')?> </a>
        </li>
        <li class="menu-item">
            <a href="<?= Url::to(['contact/index']) ?>"><?=Yii::t('app','Contact')?> </a>
        </li>
        <?php if (!Yii::$app->user->isGuest): ?>
            <li class="menu-item">
                <a href="<?= Url::to(['/cabinet/default/index']) ?>"><?=Yii::t('app','Cabinet')?> </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

