<?php

/* @var $this View */

use frontend\widgets\AccountWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

if (!Yii::$app->user->isGuest){
    /** @var User $user */
    $user = Yii::$app->user->identity->getUser();
}

?>
<!-- HEADER -->
<header id="header" class="header header-default header-fixed">
    <div class="tf-container ct2">
        <div class="row">
            <div class="col-md-12">
                <div class="sticky-area-wrap">
                    <div class="header-ct-left">
                        <div id="logo" class="logo">
                            <a href="/">
                                <img class="site-logo" src="/images/logo.png" alt="Image"/>
                            </a>
                        </div>
                        <?= $this->render('/layouts/header/_categories', []); ?>
                    </div>
                    <div class="header-ct-center">
                        <div class="nav-wrap">
                            <?= $this->render('/layouts/header/_primary_menu', []); ?>
                        </div>
                    </div>
                    <div class="header-ct-right">
                        <div class="header-customize-item help">
                            <a href="/term-of-use"><span class="icon-help-circle"></span></a>
                        </div>
                        <?php if (Yii::$app->user->isGuest): ?>
                        <div class="header-customize-item help">
                            <a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">
                                <span class="icofont icofont-login"></span>
                            </a>
                        </div>
                        <div class="header-customize-item button">
                            <a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">
                                <?=Yii::t('app','Signup')?>
                            </a>
                        </div>
                        <?php else: ?>
                            <div class="header-customize-item bell">
                                <?= $this->render('/layouts/header/_notification', []); ?>
                            </div>
                            <div class="header-customize-item account">
                                <?= AccountWidget::widget([]); ?>
                            </div>
                            <div class="header-customize-item button">
                                <a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>" data-method="post">
                                    <i class="icofont icofont-logout"></i>
                                    <?= Yii::t('app','Logout')?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="nav-filter">
                        <div class="nav-mobile"><span></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
