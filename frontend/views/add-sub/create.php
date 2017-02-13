<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AddSub */
/* @var $categories common\models\Category */
/* @var $type string */
/* @var $addSub common\models\AddSub */

$this->title = $type == 'add' ? 'Add' : 'Sub';
?>
<div class="ibox-content add-sub-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model'      => $model,
        'categories' => $categories,
        'type'       => $type,
    ]) ?>

</div>

<?= $this->render('../site/tableAddSub', [
    'addSub' => $addSub
])?>
