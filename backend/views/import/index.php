<?php


/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Import');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="import-index">

    <p>
        <?= Html::a('<i class="fa fa-upload"></i> ' . Yii::t('app', 'Upload'), ['import/upload'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
