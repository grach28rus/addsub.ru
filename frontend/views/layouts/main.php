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
    <div class="row border-bottom">
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
                    <a class="dropdown-toggle count-info" href="" data-toggle="dropdown" href="#">
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
    </div>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="#" data-action="add">
                        <i class="fa fa-plus"></i>
                        <span class="nav-label"><?=Yii::t('app', 'ADD')?></span>
                    </a>
                </li>
                <li>
                    <a href="#" data-action="sub">
                        <i class="fa fa-minus"></i>
                        <span class="nav-label"><?=Yii::t('app', 'SUB')?></span>
                    </a>
                </li>
                <li>
                    <a href="#" data-action="category">
                        <i class="fa fa-share-alt"></i>
                        <span class="nav-label"><?=Yii::t('app', 'CATEGORY')?></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg row">
        <div class="row wrapper border-bottom white-bg page-heading">
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
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <?= $content ?>
            </div>
            <div class="col-md-4 col-lg-3 col-xs-12 col-sm-12">
                <div class="ibox" style="margin: 0 0;">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5><?=Yii::t('app', 'Balance')?></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">22 285,400</h1>
                        <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
                <div class="ibox" style="margin: 0 0;">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5><?=Yii::t('app', 'Add')?></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">22 285,400</h1>
                        <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
                <div class="ibox" style="margin: 0 0 10px 0;">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5><?=Yii::t('app', 'Sub')?></h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">22 285,400</h1>
                        <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="product_name">Project Name</label>
                                    <input type="text" id="product_name" name="product_name" value="" placeholder="Project Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="price">Name</label>
                                    <input type="text" id="price" name="price" value="" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="quantity">Company</label>
                                    <input type="text" id="quantity" name="quantity" value="" placeholder="Company" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" selected="">Completed</option>
                                        <option value="0">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="footer" >
            <div>
                AddSub.ru &copy; 2017
            </div>
        </div>

    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
