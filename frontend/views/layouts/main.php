<?php

/* @var $this View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);

\kartik\icons\IcoFontAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="stylesheet" href="/fonts/fonts.css"/>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/shortcodes.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="shortcut icon" href="/images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="/css/responsive.css"/>

    <?php $this->registerCsrfMetaTags() ?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('_top'); ?>
<?= $this->render('_mobile_menu_popup'); ?>
<?= $this->render('_header'); ?>

<?= $content ?>

<?= $this->render('_footer'); ?>
<?= $this->render('_script'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
