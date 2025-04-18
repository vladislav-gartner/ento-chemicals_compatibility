<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user core\entities\User\User */
/* @var $token core\entities\User\UserToken */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/change/username', 'token' => $token->token_username]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to reset your username:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
