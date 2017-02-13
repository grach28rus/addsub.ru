<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fixed-nav">
<?php $this->beginBody() ?>
<?= \lavrentiev\widgets\toastr\NotificationFlash::widget([
    'options' => [
        "closeButton" => true,
        "debug" => false,
        "newestOnTop" => false,
        "progressBar" => false,
        "positionClass" => "toast-top-right",
        "preventDuplicates" => false,
        "onclick" => null,
        "showDuration" => "300",
        "hideDuration" => "1000",
        "timeOut" => "5000",
        "extendedTimeOut" => "1000",
        "showEasing" => "swing",
        "hideEasing" => "linear",
        "showMethod" => "fadeIn",
        "hideMethod" => "fadeOut"
    ]
]) ?>
<div id="wrapper">
    <nav class="navbar white-bg navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header" style="padding: 0 10px 0 10px">
            <h2>
                AddSub.ru
            </h2>
        </div>
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-cog" style="font-size: 20px"></i>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs ng-scope">
                    <li><a data-lang="En">English</a></li>
                    <li><a data-lang="Ru">Russian</a></li>
                </ul>
            </li>

            <li>
                <? if (!Yii::$app->user->isGuest) : ?>
                    <a id="log-out">
                        <i class="fa fa-sign-out"></i><?=Yii::t('app', 'Log out')?>
                    </a>
                <? endif; ?>
            </li>
        </ul>
    </nav>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="/add-sub/create?type=add" data-action="add" class="action-link">
                        <i class="fa fa-plus"></i>
                        <span class="nav-label"><?=Yii::t('app', 'ADD')?></span>
                    </a>
                </li>
                <li>
                    <a href="/add-sub/create?type=sub" data-action="sub" class="action-link">
                        <i class="fa fa-minus"></i>
                        <span class="nav-label"><?=Yii::t('app', 'SUB')?></span>
                    </a>
                </li>
                <li>
                    <a href="/category/create" data-action="category" class="action-link">
                        <i class="fa fa-share-alt"></i>
                        <span class="nav-label"><?=Yii::t('app', 'CATEGORY')?></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg row">
        <div class="row white-bg page-heading">
            <div class="col-lg-10">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="row wrapper wrapper-content animated" style="padding: 15px 10px 0">
            <?= $content ?>
        </div>
        <div class="footer" >
            <div>
                AddSub.ru &copy; 2017
            </div>
        </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
