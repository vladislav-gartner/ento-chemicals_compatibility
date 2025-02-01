<?php

use cebe\gravatar\Gravatar;
use common\components\Dumper;
use core\entities\User\User;

/* @var $this \yii\web\View */
/* @var $directoryAsset false|string */

use kartik\icons\Icon;
use yii\helpers\Html;

\kartik\icons\IcoFontAsset::register($this);

if (!Yii::$app->user->isGuest) {
    /** @var User $user */
    $user = Yii::$app->user->identity->getUser();
}

$type = $user->hasRole('child') ? 'child' : 'other';

?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= Gravatar::widget([
                    'email' => $user->email,
                    'options' => [
                        'alt' => $user->username,
                        'class' => 'img-circle'
                    ],
                    'size' => 64,
                ]) ?>
            </div>
            <div class="pull-left info">
                <p><?php echo $user->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'iconClassPrefix' => ''],
                'items' => [

                    ['label' => Yii::t('app','Compares'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app','Compares'), 'icon' => 'fa fa-balance-scale', 'url' => ['/compare/index']],

                ],
            ]
        ) ?>

    </section>
    <!-- /.sidebar -->
</aside>