<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\AddSub */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories common\models\Category */
?>

<div class="row add-sub-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $form->field($model, 'add')->widget(Select2::classname(), [
            'data' => [
                '0' => 'Add',
                '1' => 'Sub',
            ],
            'language' => 'ru',
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $form->field($model, 'count')->textInput() ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $form->field($model, 'category')->widget(Select2::classname(), [
            'data' => $categories,
            'language' => 'ru',
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="category-add_or_sub">-</label> <br />
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
