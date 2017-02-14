
<div class="ibox-content">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h4><?=Yii::t('app', 'Balance')?></h4>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h1 class="no-margins" id="balance"></h1>
        </div>
    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h4><?=Yii::t('app', 'Add ')?> <i class='fa fa-plus' style='color: #1ab394'></i></h4>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h1 class="no-margins" id="add"></h1>
        </div>
    </div>
</div>
<div class="ibox-content">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h4><?=Yii::t('app', 'Sub ')?> <i class='fa fa-minus' style='color: #ed5565'></i></h4>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <h1 class="no-margins" id="sub"></h1>
        </div>
    </div>
</div>
<div class="ibox-content">
    <div style="text-align: center">
        <canvas id="doughnutChart" width="200" height="200"></canvas>
    </div>
</div>