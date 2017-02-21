<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $modelSign frontend\models\SignupForm */
/* @var $modelLogin common\models\LoginForm */

use frontend\assets\AppAsset;
use yii\helpers\Html;


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
<body>
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
<div id="wrap" class="wrap">
    <nav class="navbar white-bg navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header" style="padding: 0 10px 0 10px">
            <h2>
                AddSub.ru
            </h2>
        </div>
        <div class="hidden-xs hidden-sm">
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    <a class="animation_select" data-animation="fadeInRight" href="#">
                        <i class="fa fa-cog" style="font-size: 20px"></i>
                    </a>
                    <div class="animation-box-about animated hidden">
                        <ul class="dropdown-menu" style="display: block">
                            <li><a class="change-language" data-lang="En"><?= Yii::t('app', 'English')?></a></li>
                            <li><a class="change-language" data-lang="RUS"><?= Yii::t('app', 'Russian')?></a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="animation_select" data-animation="fadeInRight">
                        <i class="fa fa-user"></i> <?=Yii::t('app', 'Sign up')?>
                    </a>
                    <div class="animation-box-about animated hidden">
                        <div class="ibox-content">
                            <?= $this->render('signup', ['model' => $modelSign])?>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="animation_select" data-animation="fadeInRight" href="#">
                        <i class="fa fa-sign-out"></i> <?=Yii::t('app', 'Sign in')?>
                    </a>
                    <div class="animation-box-about animated hidden">
                        <div class="ibox-content">
                            <?= $this->render('login', ['model' => $modelLogin])?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="hidden-md hidden-lg">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-white pull-right animation_select" data-animation="fadeInDown" style="">
                <i class="fa fa-bars"></i>
            </a>
            <div class="animation-box-nav animated hidden">
                <div class="ibox-content">
                    <div class="row">
                        <ul class="nav navbar-top-links pull-right">
                            <li>
                                <a class="animation_select" data-animation="fadeInRight" href="#">
                                    <i class="fa fa-cog" style="font-size: 20px"></i>
                                </a>
                                <div class="animation-box-about animated hidden">
                                    <ul class="dropdown-menu open" style="display: block; position: relative">
                                        <li><a class="change-language" data-lang="En"><?= Yii::t('app', 'English')?></a></li>
                                        <li><a class="change-language" data-lang="RUS"><?= Yii::t('app', 'Russian')?></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="animation_select" data-animation="fadeInRight">
                                    <i class="fa fa-user"></i> <?=Yii::t('app', 'Sign up')?>
                                </a>
                                <div class="animation-box-about animated hidden">
                                    <div class="ibox-content">
                                        <?= $this->render('signup', ['model' => $modelSign])?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="animation_select" data-animation="fadeInRight" href="#">
                                    <i class="fa fa-sign-out"></i> <?=Yii::t('app', 'Sign in')?>
                                </a>
                                <div class="animation-box-about animated hidden">
                                    <div class="ibox-content">
                                        <?= $this->render('login', ['model' => $modelLogin])?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="wrapper-content animated content" style="padding: 10px 10px">
        <div class="row no-margins">
            <div class="col-md-4 col-lg-3 hidden-xs hidden-sm" style="padding: 0 10px 0 0">
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
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9" style="padding: 0 0 0 0">
                <div class="ibox-content">
                    <h2>
                        <?= Yii::t('app', 'AddSub - money control system!') ?>
                    </h2>
                    <div>
                        <?= Yii::t('app', 'If you mindlessly spend money') . '... ' .
                        Yii::t('app', 'If you can not save') . '... ' .
                        Yii::t('app', 'Or just want to keep track of money in detail') . '... ';
                        ?>
                    </div>
                    <h4>
                        <?= Yii::t('app', 'Then, this system is for you!') ?>
                    </h4>
                </div>
                <div class="ibox-content">
                    <h2>
                        <?= Yii::t('app', 'Operation manual') ?>
                    </h2>
                    <div>
                        <br />
                        <b><?= Yii::t('app', 'Registration') ?></b> <i class="fa fa-arrow-right"></i> <b><?= Yii::t('app', 'Using') ?></b>
                    </div>
                </div>
                <div class="ibox-content">
                    <h2>
                        <?= Yii::t('app', 'Result') ?>
                    </h2>
                    <div>
                        <?= Yii::t('app', 'You trying to dumb to save money.') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        AddSub.ru &copy; 2017
    </div>
</footer>
<?
$this->registerJsFile(Yii::getAlias('js/about.js'), ['depends' => AppAsset::className()]);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
