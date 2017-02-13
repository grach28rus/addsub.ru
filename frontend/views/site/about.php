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
<body class="">
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
    <div class="row border-bottom">
        <nav class="navbar white-bg navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" style="padding: 0 10px 0 30px">
                <h2>
                    AddSub.ru
                </h2>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" href="" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog" style="font-size: 20px"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs ng-scope" ng-controller="translateCtrl">
                        <li><a ng-click="changeLanguage('en')">English</a></li>
                        <li><a ng-click="changeLanguage('es')">Spanish</a></li>
                    </ul>
                </li>
                <li>
                    <? if (Yii::$app->user->isGuest) : ?>
                        <a href="/login">
                            <i class="fa fa-user"></i> <?=Yii::t('app', 'Sign in')?>
                        </a>
                    <? endif; ?>
                </li>
                <li>
                    <? if (!Yii::$app->user->isGuest) : ?>
                        <a href="/logout">
                            <i class="fa fa-sign-out"></i> <?=Yii::t('app', 'Log out')?>
                        </a>
                    <? endif; ?>
                    <? if (Yii::$app->user->isGuest) : ?>
                        <a href="/login">
                            <i class="fa fa-sign-in"></i> <?=Yii::t('app', 'Log in')?>
                        </a>
                    <? endif; ?>
                </li>
            </ul>
        </nav>
    </div>

    <div id="" class="wrap gray-bg row" style="margin: 0 0">
        <div class="row wrapper wrapper-content animated" style="padding: 10px 10px">
            <div class="col-md-4 col-lg-3 col-xs-12 col-sm-12">
                <div class="ibox" style="margin: 0 0;">
                    <div class="ibox-title">
                        <h5><?=Yii::t('app', 'Graphics')?></h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="lineChart" height="250" width="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="ibox" style="margin: 0 0;">
                    <div class="ibox-title">
                        <h5><?=Yii::t('app', 'Current state')?></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                                <canvas id="doughnutChart" width="110" height="110"></canvas>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                                <canvas id="polarChart" width="110" height="110""></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <?= $content ?>
            </div>
        </div>
        <div class="footer" >
            <div>
                AddSub.ru &copy; 2017
            </div>
        </div>

    </div>
</div>
<?
$this->registerJsFile(Yii::getAlias('js/about.js'), ['depends' => AppAsset::className()]);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
