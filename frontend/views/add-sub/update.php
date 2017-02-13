<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AddSub */

$this->title = 'Update Add Sub: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Add Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="add-sub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
