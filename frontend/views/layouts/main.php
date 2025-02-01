<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$addClass = $this->params['addClass'] ? $this->params['addClass'] : '';

frontend\assets\AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$user = null;
if (!Yii::$app->user->isGuest){
    /** @var User $user */
    $user = Yii::$app->user->identity->getUser();
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap">

<?php $this->head() ?>

</head>

<body class="layout-top-nav skin-green-light <?= $addClass ?>">
<?php $this->beginBody() ?>

<div class="wrapper">

    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <div class="container-fluid">
        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
    </div>

    <aside class="right-control-sidebar control-sidebar-dark">
        <div class="sidebar-content">
            <h3>Условные обозначения</h3>

        </div>
    </aside>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
