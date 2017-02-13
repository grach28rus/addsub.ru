<?php
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $addSub common\models\AddSub */

$this->title = 'Dash Board';
$tableAddSub = $this->render('../site/tableAddSub', [
    'addSub' => $addSub
]);
?>

<div id="content-data" class="col-xs-12 col-sm-12 col-md-8 col-lg-9">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 empty-padding">
        <?= $this->render('dashBoard') ?>
    </div>
    <div class="hidden-xs hidden-sm col-md-12 col-lg-12 empty-padding">
        <?= $tableAddSub ?>
    </div>

</div>
<div class="col-md-4 col-lg-3 col-xs-12 col-sm-12">
    <?= $this->render('rightDashBoard') ?>
</div>
<div class="hidden-md hidden-lg col-xs-12 col-sm-12">
    <?= $tableAddSub ?>
</div>

<?
$this->registerJsFile(Yii::getAlias('js/dashBoard.js'), ['depends' => AppAsset::className()]);
?>