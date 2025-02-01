<?php

use cebe\gravatar\Gravatar;
use core\entities\User\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $directoryAsset false|string */

/** @var yii\web\UrlManager $frontend */
$frontend = Yii::$app->frontendUrlManager;

if (!Yii::$app->user->isGuest) {
    /** @var User $user */
    $user = Yii::$app->user->identity->getUser();
}

?>
<header class="main-header">

    <nav class="navbar navbar-static-top">

        <div class="container">

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

                <?php
                $menuItems = [
                    ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
                    ['label' => Yii::t('app','Compares'), 'url' => ['/compare/index']],
                ];
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => Yii::t('auth','Signup'), 'url' => ['/auth/signup/request']];
                    $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/auth/auth/login']];
                } else {
//                    $menuItems[] = ['label' => Yii::t('app','Requests'), 'url' => ['/request/index']];
                }
                echo Nav::widget([
                    'options' => ['class' => 'nav navbar-nav'],
                    'items' => $menuItems,
                ]);
                ?>

            </div>

            <form class="navbar-form navbar-left hidden-xs hidden-sm" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
            </form>

            <div class="navbar-custom-menu pull-left">
                <ul class="nav navbar-nav">

                    <?php if (!Yii::$app->user->isGuest): ?>

                        <li class="dropdown user user-menu hidden-sm">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= Gravatar::widget([
                                    'email' => $user->email,
                                    'options' => [
                                        'alt' => $user->username,
                                        'class' => 'img-circle'
                                    ],
                                    'size' => 32,
                                ]) ?>
                                <span class="hidden-xs"><?php echo $user->username; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <?= Gravatar::widget([
                                        'email' => $user->email,
                                        'options' => [
                                            'alt' => $user->username,
                                            'class' => 'img-circle'
                                        ],
                                        'size' => 64,
                                    ]) ?>
                                    <p>
                                        <?php echo $user->username; ?>
                                        <small>Member since <?=Yii::$app->formatter->asDate($user->created_at, 'long'); ?> </small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <?= Html::a(
                                            'Выход',
                                            ['/auth/auth/logout'],
                                            ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                        ) ?>
                                    </div>
                                </li>

                            </ul>
                        </li>

                    <?php endif ?>

                </ul>
            </div>

            <div class="navbar-header pull-right">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

        </div>

    </nav>

</header>
