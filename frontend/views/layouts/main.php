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
            <a href="#" data-toggle="modal" data-target="#myModal"><h3>Условные обозначения</h3></a>
        </div>
    </aside>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title text-center" id="myModalLabel">Условные обозначения</h2>
                </div>
                <div class="modal-body">
                    <div class="row content-container">
                        <div class="col-md-2">
                            <span class="full-width-label label label-success">Совместим</span>
                        </div>
                        <div class="col-md-10">
                            <p>
                                Препарат рекомендован для применения в интегрированной системе защиты, можно без опасений сочетать с энтомофагами
                                (условный урон популяции полезных насекомых или клещей менее 25%).
                            </p>
                        </div>
                    </div>

                    <div class="row content-container">
                        <div class="col-md-2">
                            <span class="full-width-label label label-warning">Частично совместим</span>
                        </div>
                        <div class="col-md-10">
                            <p>
                                Препарат рекомендован для применения в интегрированной системе защиты, но имеет влияние на популяцию энтомофагов
                                (условный возможный урон популяции полезных насекомых или клещей варьируется в пределах 50-75%, но популяция быстро
                                восстанавливается при наличии кормовой базы).
                            </p>
                        </div>
                    </div>

                    <div class="row content-container">
                        <div class="col-md-2">
                            <span class="full-width-label label label-danger">Несовместим</span>
                        </div>
                        <div class="col-md-10">
                            <p>
                                Препарат не рекомендован для использования совместно с энтомофагами (урон 90-100% с длительным периодом распада препарата).
                            </p>
                        </div>
                    </div>

                    <div class="row content-container">
                        <div class="col-md-2">
                            <span class="full-width-label label label-default">Эффект не известен</span>
                        </div>
                        <div class="col-md-10">
                            <p>
                                Препарат требует дополнительных наблюдений, применяйте его с крайней осторожностью на небольших участках.
                            </p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="row content-container">
                        <div class="col-md-12">
                            <h4 class="text-center" >Совместимость препаратов и энтомофагов носит условный характер.</h4>
                        </div>
                    </div>

                    <div class="row content-container">
                        <div class="col-md-12">
                            <p class="text-center" >Рекомендуем всегда консультироваться с нашими специалистами и актуализировать данные.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
