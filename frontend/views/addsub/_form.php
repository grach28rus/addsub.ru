<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AddSub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="add-sub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_code')->textInput() ?>

    <?= $form->field($model, 'add')->checkbox() ?>

    <?= $form->field($model, 'sub')->checkbox() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'uodate_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
