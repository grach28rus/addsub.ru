<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AddSub */
/* @var $categories common\models\Category */

$this->title = 'Add';
?>
<div class="ibox-content add-sub-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
