<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $addSub common\models\AddSub */
/* @var $category array */
/* @var $addSubSearch \frontend\models\AddSubSearch */

$this->title = 'Dash Board';

$dataType = [
    '1' => 'Add',
    '0' => 'Sub'
];
$iterator = 1;
?>
<div class="row">
    <div id="content-data" class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 empty-padding">
            <?= $this->render('dashBoard') ?>
        </div>
        <div class="hidden-xs hidden-sm col-md-12 col-lg-12 empty-padding">
            <div class="ibox-content">
                <? if (Yii::$app->controller->id == 'site') : ?>
                    <div class="row">
                        <?php $form = ActiveForm::begin(['action' => '/site/search']); ?>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="product_name"><?=Yii::t('app', 'Add/Sub')?></label>
                                <?= $form->field($addSubSearch, 'add')->widget(Select2::classname(), [
                                    'data' => $dataType,
                                    'language' => 'ru',
                                    'options'  => [
                                        'class'       => 'change-filter',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear'  => true,
                                        'placeholder' => 'Add/Sub...',
                                    ],
                                ])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="price"><?=Yii::t('app', 'Count')?></label>
                                <?= $form->field($addSubSearch, 'count')->textInput(
                                    [
                                        'placeholder' => Yii::t('app', 'Count') . '...',
                                        'class'       => 'form-control change-filter'
                                    ]
                                )->label(false) ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="quantity"><?=Yii::t('app', 'Category')?></label>
                                <?= $form->field($addSubSearch, 'category')->widget(Select2::classname(), [
                                    'data' => $category,
                                    'language' => 'ru',
                                    'options'  => [
                                        'class'       => 'change-filter',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear'  => true,
                                        'placeholder' => Yii::t('app', 'Category') . '...',
                                    ],
                                ])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 empty-padding">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="status"><?=Yii::t('app', 'Created At')?></label>
                                    <?= $form->field($addSubSearch, 'create_at_from')->widget(DatePicker::classname(), [
                                        'language' => 'ru',
                                        'options' => [
                                            'placeholder' => Yii::t('app', 'From') . '...',
                                            'class' => 'change-filter',
                                        ],
                                        'removeButton' => false,
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd',
                                            'autoclose'=>true,
                                        ]
                                    ])->label(false); ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label" for="status"><?=Yii::t('app', 'Created At')?></label>
                                    <?= $form->field($addSubSearch, 'create_at_to')->widget(DatePicker::classname(), [
                                        'language' => 'ru',
                                        'options' => [
                                            'placeholder' => Yii::t('app', 'To') . '...',
                                            'class' => 'change-filter',
                                        ],
                                        'removeButton' => false,
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd',
                                            'autoclose'=>true,
                                        ]
                                    ])->label(false); ?>
                                </div>
                            </div>

                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                <? endif; ?>
                <div class="table-responsive table-result-search">
                    <?= $this->render('tableAddSub', [
                        'addSub' => $addSub
                    ])?>
                </div>

            </div>
        </div>

    </div>
    <? $iterator = 1; ?>
    <div class="col-md-4 col-lg-3 col-xs-12 col-sm-12 ">
        <?= $this->render('rightDashBoard', [
        ]) ?>
    </div>
    <div class="hidden-md hidden-lg col-xs-12 col-sm-12">
        <div class="ibox-content">
            <? if (Yii::$app->controller->id == 'site') : ?>
                <div class="row">
                    <?php $form = ActiveForm::begin(['action' => '/site/search']); ?>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="product_name"><?=Yii::t('app', 'Add/Sub')?></label>
                            <?= $form->field($addSubSearch, 'add')->widget(Select2::classname(), [
                                'data' => $dataType,
                                'language' => 'ru',
                                'options'  => [
                                    'class'       => 'change-filter',
                                ],
                                'pluginOptions' => [
                                    'allowClear'  => true,
                                    'placeholder' => 'Add/Sub...',
                                ],
                            ])->label(false); ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="price"><?=Yii::t('app', 'Count')?></label>
                            <?= $form->field($addSubSearch, 'count')->textInput(
                                [
                                    'placeholder' => Yii::t('app', 'Count') . '...',
                                    'class'       => 'form-control change-filter'
                                ]
                            )->label(false) ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="quantity"><?=Yii::t('app', 'Category')?></label>
                            <?= $form->field($addSubSearch, 'category')->widget(Select2::classname(), [
                                'data' => $category,
                                'language' => 'ru',
                                'options'  => [
                                    'class'       => 'change-filter',
                                ],
                                'pluginOptions' => [
                                    'allowClear'  => true,
                                    'placeholder' => Yii::t('app', 'Category') . '...',
                                ],
                            ])->label(false); ?>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 empty-padding">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="status"><?=Yii::t('app', 'Created At')?></label>
                                <?= $form->field($addSubSearch, 'create_at_from')->widget(DatePicker::classname(), [
                                    'language' => 'ru',
                                    'options' => [
                                        'placeholder' => Yii::t('app', 'From') . '...',
                                        'class' => 'change-filter',
                                    ],
                                    'removeButton' => false,
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'autoclose'=>true,
                                    ]
                                ])->label(false); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for="status"><?=Yii::t('app', 'Created At')?></label>
                                <?= $form->field($addSubSearch, 'create_at_to')->widget(DatePicker::classname(), [
                                    'language' => 'ru',
                                    'options' => [
                                        'placeholder' => Yii::t('app', 'To') . '...',
                                        'class' => 'change-filter',
                                    ],
                                    'removeButton' => false,
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'autoclose'=>true,
                                    ]
                                ])->label(false); ?>
                            </div>
                        </div>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            <? endif; ?>
            <div class="table-responsive table-result-search">
                <?= $this->render('tableAddSub', [
                    'addSub' => $addSub
                ])?>
            </div>

        </div>
    </div>
</div>

<?
$this->registerJsFile(Yii::getAlias('js/index.js'), ['depends' => AppAsset::className()]);
?>