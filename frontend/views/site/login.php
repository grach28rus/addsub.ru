<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/site/login']); ?>
                <h2><?= Html::encode($this->title) ?></h2>
                <p>
                    <?=Yii::t('app', 'Please fill out the following fields to login:')?>
                </p>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
