<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';

?>
<div class="site-signup">
    <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => '/site/signup']); ?>
            <h2><?= Html::encode($this->title) ?></h2>

            <p>
                <?=Yii::t('app', 'Please fill out the following fields to signup:')?>
            </p>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
