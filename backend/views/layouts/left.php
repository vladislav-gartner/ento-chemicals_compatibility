<?php

$menus = require __DIR__ . '/_menu.php';

use cebe\gravatar\Gravatar;
use core\entities\User\User;
use core\helpers\MenuHelper;

/** @var User $user */
$user = Yii::$app->user->identity->getUser();

use kartik\icons\Icon;
\kartik\icons\IcoFontAsset::register($this);

?>
<aside class="main-sidebar">

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

<?//= $this->render('_search') ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', 'iconClassPrefix' => ''],
                'items' => MenuHelper::merge([
                    ['label' => Yii::t('app','Chemicals'), 'options' => ['class' => 'header']],

                    ['label' => Yii::t('app','Chemicals'), 'icon' => 'icofont icofont-medicine', 'url' => ['/chemical/index']],
                    ['label' => Yii::t('app','Ingredients'), 'icon' => 'icofont icofont-laboratory', 'url' => ['/ingredient/index']],
                    ['label' => Yii::t('app','Chemical Ingredient Assignments'), 'icon' => 'icofont icofont-ui-social-link', 'url' => ['/chemical-ingredient-assignment/index']],
                    ['label' => Yii::t('app','Chemical Entomophage Matches'), 'icon' => 'icofont icofont-match-review', 'url' => ['/chemical-entomophage-match/index']],

                    ['label' => Yii::t('app','Entomophages'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app','Entomophages'), 'icon' => 'icofont icofont-bug', 'url' => ['/entomophage/index']],

                    ['label' => Yii::t('app','Compares'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app','Compares'), 'icon' => 'fa fa-balance-scale', 'url' => ['/compare/index']],
                    ['label' => Yii::t('app','Compare Chemical Assignments'), 'icon' => 'fa fa-book', 'url' => ['/compare-chemical-assignment/index']],
                    ['label' => Yii::t('app','Compare Entomophage Assignments'), 'icon' => 'fa fa-book', 'url' => ['/compare-entomophage-assignment/index']],

                    ['label' => Yii::t('app','Lookups'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app','Matches'), 'icon' => 'fa fa-book', 'url' => ['/match/index']],

                    ['label' => 'Обработчики', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app','Import'), 'icon' => 'icofont icofont-automation', 'url' => ['/import/index']],

                ], $menus)
            ]
        ) ?>

    </section>

</aside>
