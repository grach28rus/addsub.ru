<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?= $form->field($model, 'name')->textInput() ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?= $form->field($model, 'add_or_sub')->widget(Select2::classname(), [
            'data' => [
                '1' => 'Add',
                '0' => 'Sub',
            ],
            'language' => 'ru',
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
            <label class="control-label" for="category-add_or_sub">-</label> <br />
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'id' => 'submit-form']) ?>
            <div class="help-block"></div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
