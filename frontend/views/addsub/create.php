<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AddSub */

$this->title = 'Create Add Sub';
$this->params['breadcrumbs'][] = ['label' => 'Add Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
